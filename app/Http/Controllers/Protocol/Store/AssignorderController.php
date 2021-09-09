<?php

namespace App\Http\Controllers\Protocol\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use App\Traits\SendSms;
use Validator;
class AssignorderController extends Controller
{
    use SendSms;
    public function assignedorders(Request $request)
    {
        $title = "Order section (Today)";
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
        //echo"<pre>";print_r($store);die;
    	 $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
          $date = date('Y-m-d');      
        $ord =DB::connection('mysql_sec')->table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->leftjoin('delivery_boy', 'orders.dboy_id','=','delivery_boy.dboy_id')
             ->where('orders.store_id',$store->store_id)
             ->where('orders.delivery_date',$date)
             ->where('payment_method', '!=', NULL)
             ->where('orders.order_status','!=',0)
			->orWhere('orders.order_status','!=',4)
             ->get();
         //echo"<pre>";print_r($ord);die;    
         $details  =   DB::connection('mysql_sec')->table('orders')
    	                ->join('store_orders', 'orders.cart_id', '=', 'store_orders.order_cart_id') 
    	               ->where('orders.store_id',$store->store_id)
    	               ->where('store_orders.store_approval',1)
    	               ->get();         
                
           $nearbydboy = DB::connection('mysql_sec')->table('delivery_boy')
                ->leftJoin('orders', 'delivery_boy.dboy_id', '=', 'orders.dboy_id') 
                ->select("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city",DB::connection('mysql_sec')->raw("Count(orders.order_id)as count"),DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$store->lat . ")) 
                * cos(radians(delivery_boy.lat)) 
                * cos(radians(delivery_boy.lng) - radians(" . $store->lng . ")) 
                + sin(radians(" .$store->lat. ")) 
                * sin(radians(delivery_boy.lat))) AS distance"))
               ->groupBy("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city")
               //->where('delivery_boy.boy_city', $store->city)
               ->orderBy('distance')
               ->get();  	       
       return view('protocol.store.orders.assignedorders', compact('title','logo','ord','store','details','nearbydboy'));         
    }
        
    
  public function orders(Request $request)
    {
          $title = "Order section (Next Day)";
		 $date = date('Y-m-d');
         $day = 1;
         $next_date = date('Y-m-d', strtotime($date.' + '.$day.' days'));
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	 $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        $ord =DB::connection('mysql_sec')->table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
			->leftjoin('delivery_boy', 'orders.dboy_id','=','delivery_boy.dboy_id')
             ->where('orders.store_id',$store->store_id)
             ->where('orders.delivery_date', $next_date)
              ->where('orders.order_status','!=',0)
			->orWhere('orders.order_status','!=',4)
             ->where('payment_method', '!=', NULL)
             ->get();
             
         $details  =   DB::connection('mysql_sec')->table('orders')
    	                ->join('store_orders', 'orders.cart_id', '=', 'store_orders.order_cart_id') 
    	               ->where('orders.store_id',$store->store_id)
    	               ->where('store_orders.store_approval',1)
    	               ->get();            
          $store_id = $store->store_id;
    	 		   
    	  $nearbydboy = DB::connection('mysql_sec')->table('delivery_boy')
                ->leftJoin('orders', 'delivery_boy.dboy_id', '=', 'orders.dboy_id') 
                ->select("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city",DB::connection('mysql_sec')->raw("Count(orders.order_id)as count"),DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$store->lat . ")) 
                * cos(radians(delivery_boy.lat)) 
                * cos(radians(delivery_boy.lng) - radians(" . $store->lng . ")) 
                + sin(radians(" .$store->lat. ")) 
                * sin(radians(delivery_boy.lat))) AS distance"))
               ->groupBy("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city")
               //->where('delivery_boy.boy_city', $store->city)
               ->orderBy('distance')
               ->get();
            //echo"<pre>";print_r($nearbydboy);die;	        
       return view('protocol.store.orders.orders', compact('title','logo','ord','store','details', 'nearbydboy'));         
    }    

   
   
   
       
    public function confirm_order(Request $request)
    {
       $cart_id= $request->cart_id;
       $dboy_id = $request->dboy_id;
        $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
        $store_id = $store->store_id;  
        $curr = DB::connection('mysql_sec')->table('currency')
             ->first();      
        
          $orr =   DB::connection('mysql_sec')->table('orders')
                ->where('cart_id',$cart_id)
                ->first();
           $userssss =  DB::connection('mysql_sec')->table('users')
                ->where('user_id',$orr->user_id)
                ->first();      
         $user_phone=$userssss->user_phone;       
          $v = DB::connection('mysql_sec')->table('store_orders')
 		   ->where('order_cart_id',$cart_id)
 		   ->get(); 
 		 
        $getDDevice = DB::connection('mysql_sec')->table('delivery_boy')
                         ->where('dboy_id', $dboy_id)
                        ->select('device_id','boy_name')
                        ->first();  
 		    
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
                    'dboy_id'=>$dboy_id]);
                    
          $v = DB::connection('mysql_sec')->table('store_orders')
 		   ->where('order_cart_id',$cart_id)
 		   ->get();  
 		   
         if($orderconfirm){
              //send sms and app notification to user//
              $sms = DB::connection('mysql_sec')->table('notificationby')
                       ->select('sms','app')
                       ->where('user_id',$orr->user_id)
                       ->first();
            $sms_status = $sms->sms;
                if($sms_status == 1){
                $codorderplaced = $this->orderconfirmedsms($cart_id,$user_phone,$orr);
                }

            if($sms->app == 1){
                  $notification_title = "WooHoo! Your Order is Confirmed";
                $notification_text = "Your Order is confirmed: Your order id #".$cart_id." is confirmed by the store.You can expect your item(s) will be delivered on ".$orr->delivery_date." (".$orr->time_slot.").";
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::connection('mysql_sec')->table('users')
                         ->where('user_id', $orr->user_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::connection('mysql_sec')->table('fcm')
                            ->where('id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->server_key;
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
                    
             
                $dd = DB::connection('mysql_sec')->table('user_notification')
                    ->insert(['user_id'=>$orr->user_id,
                     'noti_title'=>$notification_title,
                     'noti_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
             
            }
             
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
                $token = $getDDevice->device_id;
                    
        
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
             
             
        	return redirect()->back()->withSuccess('Order is confirmed and Assigned to '.$getDDevice->boy_name);
              }
    	else{
    	return redirect()->back()->withErrors('Already Assigned to '.$getDDevice->boy_name);
    	} 
    }
            
    
   
   
}      