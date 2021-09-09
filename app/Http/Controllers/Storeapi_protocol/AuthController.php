<?php

namespace App\Http\Controllers\Storeapi_protocol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use App\Store;
use DB;
use Validator;
use JWTAuth;
use Auth;
use Hash;
use JWTAuthException;
class AuthController extends Controller
{
    private $store;
    public function __construct(Store $store){
        $this->store = $store;
    }
   
    public function register(Request $request){
        $store = $this->store->create([
          'employee_name' => $request->get('employee_name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password'))
        ]);
        return apiResponse(true,200,$store);
    }

    public function MobileLogin(Request $request){
             $validation = Validator::make($request->all(), [
                'user_phone' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $credentials = $request->only('user_phone');
        $data =$credentials;
        $data['otp_value'] =$otp = rand(1000, 9999);

        $user = DB::connection('mysql_sec')->table('users')->where($credentials)->first();
        if($user){
            DB::connection('mysql_sec')->table('users')->where($credentials)->update($data);
        }else{
            DB::connection('mysql_sec')->table('users')->insert($data);
        }
        return apiResponse(true,202,$data);
    }
    
    public function loginverify(Request $request){
        $validation = Validator::make($request->all(), [
                'user_phone' => 'required',
                'otp_value' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $credentials = $request->only('user_phone', 'otp_value');
        $token = null;
        $user = User::where($credentials)->first();
        if(!$user){
            return apiResponse(false,422,'Invalid Credentials');
        }
        //echo"<pre>";print_r($user);die;
        try {
           if (!$token = JWTAuth::fromUser($user)) {
                return apiResponse(false,422,'Invalid Credentials');
           }
        } catch (JWTAuthException $e) {
            return apiResponse(false,422,'Invalid Credentials');
        }
        $data['token'] = $token;
        $data['user'] = $user;
        return apiResponse(true,200,$data);
    }

    public function getAuthUser(Request $request){
        // $validation = Validator::make($request->all(), [
        //         'token' => 'required'
        // ]);
        // if($validation->fails()) {
        //     return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        // }

        //$user = JWTAuth::toUser($request->token);
        $user = auth('store_api')->user();
        $address = DB::connection('mysql_sec')->table('address')->where(['user_id'=>$user->user_id,'select_status'=>1])->first();
        $user->address=$address;
        return apiResponse(true,200,$user);
    }

    public function UserUpdate(Request $request){
         $validation = Validator::make($request->all(), [
                'store_name' => 'required',
                'employee_name' => 'required',
                'phone_number' => 'required',
                'city' => 'required',
                'email' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'address' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
            $data = $request->except('token');

            $user = auth('store_api')->user();
            $user = $user->update($data);
            return apiResponse(true,200,$user);
        }
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

        $user = auth('store_api')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return apiResponse(false,422,'Invalid Credentials');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return apiResponse(true,204,'Password successfully changed!');
    }

    public function StoreIsActive(Request $request){
        $validation = Validator::make($request->all(), [
                'status' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $user = auth('store_api')->user();
        $user->status = $request->status;
        $user = $user->save();
        if($request->status ==1){
            $msg ='You Are Enable Now';
        }else{
            $msg ='You are Disable Now';
     }
      return apiResponse(true,204,$msg);
    }

    public function storeLogin(Request $request)
    { 
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'device_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        if ($token = auth('store_api')->attempt(request()->only('email', 'password'))) {
            $store = auth('store_api')->user();
            $store->update(request()->only('device_id'));
            return apiResponse(true,200,$this->createNewToken($token));
        }else{
            return apiResponse(false,422,'Invalid Credentials');
        }
    }

    protected function createNewToken($token){
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('store_api')->factory()->getTTL() * 60,
            'user' => auth('store_api')->user()
        ];
    }

}
