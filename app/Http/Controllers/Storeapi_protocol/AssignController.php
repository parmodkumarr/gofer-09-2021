<?php

namespace App\Http\Controllers\Storeapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;

class AssignController extends Controller
{
 public function delivery_boy_list (Request $request)
     {
        $store = auth('store_api')->user();
        $store_id = $store->store_id;
        $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('store_id',$store_id)
    	 		   ->first();
    	 		   
    	  $nearbydboy = DB::connection('mysql_sec')->table('delivery_boy')
                ->leftJoin('orders', 'delivery_boy.dboy_id', '=', 'orders.dboy_id') 
                ->select("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city",DB::connection('mysql_sec')->raw("Count(orders.order_id)as count"),DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$store->lat . ")) 
                * cos(radians(delivery_boy.lat)) 
                * cos(radians(delivery_boy.lng) - radians(" . $store->lng . ")) 
                + sin(radians(" .$store->lat. ")) 
                * sin(radians(delivery_boy.lat))) AS distance "))
               ->groupBy("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city")
               //->where('delivery_boy.boy_city', $store->city)
               ->where('delivery_boy.status','1')
               ->orderBy('distance')
               ->get();  	
               
        if (count($nearbydboy)>0){
            return apiResponse(true,202,$nearbydboy);
        }else{
            return apiResponse(false,422,'Empty ! Plaese add delivery boy');	
    	} 
    	
   }
   
   
    public function storeconfirm(Request $request)
    {
        $validation = Validator::make($request->all(), [
                'store_id' => 'required',
                'cart_id' => 'required',
                'dboy_id' => 'required',
        ]);
        if($validation->fails()) {
            return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        }
       $cart_id= $request->cart_id;
       $dboyid = $request->dboy_id;
       $store_id = $request->store_id;
      
       $curr = DB::connection('mysql_sec')->table('currency')
             ->first();
       
     $store= DB::connection('mysql_sec')->table('store')
        	->where('store_id',$store_id)
    	 	->first();
       
    $getDevice = DB::connection('mysql_sec')->table('delivery_boy')
             ->where('dboy_id', $dboyid)
            ->select('device_id','boy_name')
            ->first(); 
        $orr =   DB::connection('mysql_sec')->table('orders')
                ->where('cart_id',$cart_id)
                ->first();
                    
           $v = DB::connection('mysql_sec')->table('store_orders')
 		   ->where('order_cart_id',$cart_id)
 		   ->get(); 
          foreach($v as $vs){
                $qt = $vs->qty;
                $pr = DB::connection('mysql_sec')->table('store_products')
            ->join('product_varient','store_products.varient_id','=','product_varient.varient_id') 
            ->join('product','product_varient.product_id','=','product.product_id')
           ->where('store_products.varient_id',$vs->varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
                 $stoc = DB::connection('mysql_sec')->table('store_products')
                    ->where('varient_id',$vs->varient_id)
                    ->where('store_id',$store_id) 
                    ->first();
              if($stoc){     
                $newstock = $stoc->stock - $qt;     
                $st = DB::connection('mysql_sec')->table('store_products')
                    ->where('varient_id',$vs->varient_id)
                    ->where('store_id',$store_id)
                    ->update(['stock'=>$newstock]);
              }
             }       
       $orderconfirm = DB::connection('mysql_sec')->table('orders')
                    ->where('cart_id',$cart_id)
                    ->update(['order_status'=>'Confirmed',
                    'dboy_id'=>$dboyid]);
         
 		   
         if($orderconfirm){
                $notification_title = "You Got a New Order for Delivery on ".$orr->delivery_date;
                $notification_text = "you got an order with cart id #".$cart_id." of price ".$curr->currency_sign." " .$orr->total_price. ". It will have to delivered on ".$orr->delivery_date." between ".$orr->time_slot.".";
                
                $date = date('d-m-Y');
                $getUser = DB::connection('mysql_sec')->table('delivery_boy')
                                ->get();
        
                $created_at = Carbon::now();
        
                
                $getFcm = DB::connection('mysql_sec')->table('fcm')
                            ->where('id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->driver_server_key;
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                $token = $getDevice->device_id;
                    
        
                    $notification = [
                        'title' => $notification_title,
                        'body' => $notification_text,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification];
        
                    $fcmNotification = [
                        'to'        => $token,
                        'notification' => $notification,
                        'data' => $extraNotificationData,
                    ];
        
                    $headers = [
                        'Authorization: key='.$getFcmKey,
                        'Content-Type: application/json'
                    ];
        
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                   $results = json_decode($result);
             
                return array('status'=>200,'message'=>'success','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$getDevice->boy_name);
              }
    	else{
            return array('status'=>200,'message'=>'Already Assigned to '.$getDevice->boy_name,'image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$getDevice->boy_name);
    	} 
   
    }
   

    public function allocateDriver(Request $request)
    {
       $validation = Validator::make($request->all(), [
                'order_id' => 'required',
                'dboy_id' => 'required',
        ]);

        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
          $order_id = $request->order_id;
          $dboy_id = $request->dboy_id;
            DB::connection('mysql_sec')->table('orders')
                    ->where('order_id',$order_id)
                    ->update(['order_status'=>3,
                    'dboy_id'=>$dboy_id,'dboy_request_at'=>Carbon::now()]);

            driverNoctification('You have request for order Delivery','You have request for order delivery please accept if you are ready',$dboy_id);
            return apiResponse(true,204,'Assigned to Successfully');
        }
    }

    public function removeDriver(Request $request)
    {
       $validation = Validator::make($request->all(), [
                'order_id' => 'required'
        ]);

        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
            $order_id = $request->order_id;
            $order = DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->first();

            DB::connection('mysql_sec')->table('orders')
                ->where('order_id',$order_id)
                ->update(['order_status'=>2,
                'dboy_id'=>0,'dboy_request_at'=>NULL]);

           // if($order->dboy_id != '0' || $order->dboy_id != NULL){
                driverNoctification('Removed','You are Removed for Delivery order',$order->dboy_id);
            //}
            
            return apiResponse(true,204,'Removed Successfully');
        }
    }
   
   
}      