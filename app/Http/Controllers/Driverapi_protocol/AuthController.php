<?php

namespace App\Http\Controllers\Driverapi_protocol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use App\Driver;
use DB;
use Validator;
use JWTAuth;
use Auth;
use Hash;
use JWTAuthException;
class AuthController extends Controller
{
    private $diver;
    public function __construct(Driver $diver){
        $this->diver = $diver;
    }
   
    public function register(Request $request){
        $validation = Validator::make($request->all(), [
                'boy_name' => 'required',
                'boy_phone' => 'required|digits:10|unique:delivery_boy,boy_phone',
                'password' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $diver = Driver::create([
          'boy_name' => $request->get('boy_name'),
          'boy_phone' => $request->get('boy_phone'),
          'password' => bcrypt($request->get('password'))
        ]);
        return apiResponse(true,200,$diver);
    }

    public function MobileLogin(Request $request){
             $validation = Validator::make($request->all(), [
                'boy_phone' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $credentials = $request->only('user_phone');
        $data =$credentials;
        $data['otp_value'] =$otp = rand(1000, 9999);

        $user = Driver::where($credentials)->first();
        if($user){
            Driver::where($credentials)->update($data);
        }else{
            Driver::insert($data);
        }
        return apiResponse(true,200,$data);
    }
    
    public function loginverify(Request $request){
        $validation = Validator::make($request->all(), [
                'boy_phone' => 'required',
                'otp_value' => 'required',
                'device_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }


        $credentials = $request->only('boy_phone', 'otp_value');
        $token = null;
        $user = Driver::where($credentials)->first();
        if(!$user){
            return apiResponse(false,422,'Invalid Credentials');
        }
        //echo"<pre>";print_r($user);die;
        try {
            $credentials['password'] ='';
           if (!$token = auth('driver_api')->login($user)) {  
                return apiResponse(false,422,'Invalid Credentials');
           }
        } catch (JWTAuthException $e) {
            return apiResponse(false,422,'Failed To Authenticate');
        }
        $user->update($request->only('device_id'));
        $data['token'] = $token;
        $data['user'] = $user;
        return apiResponse(true,202,$data);
    }

    public function updatePassword(Request $request){
        $validation = Validator::make($request->all(), [
                'current_password' => 'required',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $user = auth('driver_api')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return apiResponse(false,422,'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return apiResponse(true,204,'Password successfully changed!');

    }

    public function DriverIsActive(Request $request){
        $validation = Validator::make($request->all(), [
                'status' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $user = auth('driver_api')->user();
        $user->status = $request->status;
        $user = $user->save();
        if($request->status ==1){
            $msg ='You Are Enable Now';
        }else{
            $msg ='You are Disable Now';
        }
        return apiResponse(true,204,$msg);
    }

    public function getAuthUser(Request $request){

        $user = auth('driver_api')->user();
        return apiResponse(true,200,$user);
    }

    public function UserUpdate(Request $request){
        $user =  auth('driver_api')->user();
         $validation = Validator::make($request->all(), [
                'boy_name' => 'required',
                'boy_phone' => 'required',
                'boy_city' => 'required',
                'boy_loc' => 'required',
                'lat' => 'required',
                'lng' => 'required',
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
            
            $user = $user->update($data);
            return apiResponse(true,200,$user);
        }
    }

    public function driverLogin(Request $request)
    { 
        $validation = Validator::make($request->all(), [
            'boy_phone' => 'required',
            'password' => 'required',
            'device_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $credentials = request()->only('boy_phone');
        $user = Driver::where($credentials)->first();

        if ($token = auth('driver_api')->attempt(request()->only('boy_phone', 'password'))) {
            $user->update(['device_id'=>$request->device_id]);
            return apiResponse(true,200,$this->createNewToken($token));
        }else{
            return apiResponse(false,422,'Invalid Credentials');
        }
    }

    protected function createNewToken($token){
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('driver_api')->factory()->getTTL() * 60,
            'user' => auth('driver_api')->user()
        ];
    }

}
