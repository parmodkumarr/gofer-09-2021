<?php

namespace App\Http\Controllers\Storeapi_protocol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use DB;

class StoreController extends Controller{


    public function getOrdersList(Request $request){
        
        $validation = Validator::make($request->all(), [
                'store_owner_id' => 'required'
        ]);
        if($validation->fails()) {
            return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        }

        $store_owner_id = $request->store_owner_id;

        $is_storeOwnerExist = DB::connection('mysql_sec')->table('store_owner')->where('id',$store_owner_id)->first();

        if($is_storeOwnerExist){

            $owner_all_stores = DB::connection('mysql_sec')->table('store')->where('owner_id',$store_owner_id)->pluck('store_id')->toArray();
            
            if(count($owner_all_stores)>0){

                $orders = DB::connection('mysql_sec')->table('orders')->whereIn('store_id',$owner_all_stores)->get();
                return array('status'=>200,'message'=>'success','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$orders);
            }else{

                return array('status'=>400,'message'=>'Selected Store doesnt have Orders','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/');
            }
            
        }else{

            return array('status'=>400,'message'=>'Store Owner not Exist','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/');
        }
    }


    public function getOrderDetail(Request $request){

        $validation = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);

        if($validation->fails()) {
            return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        }

        $order_id = $request->order_id;
        $detail = DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->first();

        if($detail){

            return array('status'=>200,'message'=>'Success','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$detail);

        }else{

            return array('status'=>400,'message'=>'Order Does not Exist','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
        }

    }


}