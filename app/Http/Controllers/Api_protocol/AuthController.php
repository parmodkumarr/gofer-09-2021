<?php

namespace App\Http\Controllers\Api_protocol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Validator;
use JWTAuth;
use Auth;
use JWTAuthException;
class AuthController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){
        $user = $this->user->create([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password'))
        ]);
        return apiResponse(true, 200,$user);
    }

    public function MobileLogin(Request $request){
        $validation = Validator::make($request->all(), [
                'user_phone' => 'required',
                'user_name' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $credentials = $request->only('user_phone');
        $data =$credentials;
        $data['otp_value'] = $otp = rand(1000, 9999);
        $data['user_name'] = $request->user_name;

        $user = DB::connection('mysql_sec')->table('users')->where($credentials)->first();
        if($user){
            DB::connection('mysql_sec')->table('users')->where($credentials)->update($data);
        }else{
            DB::connection('mysql_sec')->table('users')->insert($data);
        }
        return apiResponse(true, 200,$data);
    }
    
    public function loginverify(Request $request){
        $validation = Validator::make($request->all(), [
                'user_phone' => 'required',
                'otp_value' => 'required',
                'device_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }


        $credentials = $request->only('user_phone', 'otp_value');
        $token = null;
        $user = User::where($credentials)->first();
        if(!$user){
            return apiResponse(false,401,'Invalid Credentials');
        }
        //echo"<pre>";print_r($user);die;
        try {
           if (!$token = auth('api')->login($user)) {
                return apiResponse(false,401,'Invalid Credentials');
           }
        } catch (JWTAuthException $e) {
            return apiResponse(false,401,'Failed To Authenticate');
        }

        $user->update(['device_id'=>$request->device_id]);
        
        $data['token'] = $token;
        $data['user'] = $user;
        return apiResponse(true, 200, $data);
    }

    public function getAuthUser(Request $request){
        $user = auth('api')->user();
        $address = DB::connection('mysql_sec')->table('address')->where(['user_id'=>$user->user_id,'select_status'=>1])->first();
        $user->address=$address;
        return apiResponse(true, 200, $user);
    }

    public function UserUpdate(Request $request){
         $validation = Validator::make($request->all(), [
                'user_phone' => 'required',
                'user_name' => 'required',
                'user_email' => 'required',
                'user_image' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
            $data = $request->except('token');
            if(isset($data['user_image'])){
                \Storage::disk('local')->put('public/userprofile', $data['user_image']);
                $name = 'public/userprofile/'.$data['user_image']->hashName();
                $data['user_image'] = $name;
            }
           $jwtuser =  auth('api')->user();
            $user = User::where('user_id',$jwtuser->user_id)->first();
            $user = $user->update($data);
            return apiResponse(true, 200, $user);
        }
    }

    public function JwtAuthUser($token){
        $user = JWTAuth::toUser($token);
        return  $user;
    }
}
