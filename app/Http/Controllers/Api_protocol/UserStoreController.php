<?php

namespace App\Http\Controllers\Api_protocol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuthException;
use Validator;
use App\User;
use JWTAuth;
use Auth;
use DB;

class UserStoreController extends Controller{


	public function getUserOrdersList(Request $request){

		$validation = Validator::make($request->all(), [
                'token' => 'required'
        ]);

        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $user = auth('api')->user();
        //echo"<pre>";print_r($user);die;
        $user_id = $user->user_id;

        $orders = DB::connection('mysql_sec')->table('orders')->where('user_id',$user_id)
        ->where('order_status','!=',5)->get();
        
        if(count($orders)>0){
            return apiResponse(true,202,$orders);
        }else{
            return apiResponse(false,422,'Selected Store doesnt have Orders');
        }

	}


	public function getUserOrderDetail(Request $request){

		$validation = Validator::make($request->all(), [
                // 'token' => 'required',
                'order_id' => 'required'
        ]);

        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $user = auth('api')->user();
        $user_id = $user->user_id;

        $order_id = $request->order_id;

        $orders = DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->first();
        
        if($orders){
            return apiResponse(true,202,$orders);
        }else{
            return apiResponse(false,422,'You not have any Order');
        }

	}

}