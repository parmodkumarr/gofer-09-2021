<?php

namespace App\Http\Controllers\Api_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use JWTAuth;
use Auth;
use Carbon\Carbon;
use App\Traits\SendMail;
use App\Traits\SendSms;
use Razorpay\Api\Api;
use Validator;

class OrderController extends Controller
{
   use SendMail; 
   use SendSms;
   public function order(Request $request)
    {
        $current = Carbon::now();
        $user = auth('api')->user();
        $user_id    = $user->user_id;
        //$data = $request->order_array;
        //$data_array = json_decode($data);
        $data_array = DB::connection('mysql_sec')->table('cart_items')->where('user_id',$user_id)->get();
        
        $delivery_date = $request->delivery_date;
        $time_slot = $request->time_slot;
        $store_id  = $request->store_id;
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $val = "";
                for ($i = 0; $i < 4; $i++){
                    $val .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
        $chars2 = "0123456789";
                $val2 = "";
                for ($i = 0; $i < 2; $i++){
                    $val2 .= $chars2[mt_rand(0, strlen($chars2)-1)];
                }        
        $cr  = substr(md5(microtime()),rand(0,26),2);
        $cart_id = $val.$val2.$cr;
        $ar= DB::connection('mysql_sec')->table('address')
            ->select('society','city','lat','lng','address_id')
            ->where('user_id', $user_id)
            ->where('select_status', 1)
            ->first();
       if(!$ar){
           	$message = array('status'=>'0', 'message'=>'Select any Address');
        	return $message;
       }
        $created_at = Carbon::now();
        $user_id= $user->user_id;
        $price2=0;
        $price5=0;
        $ph = DB::connection('mysql_sec')->table('users')
                  ->select('user_phone','wallet')
                  ->where('user_id',$user_id)
                  ->first();
        $user_phone = $ph->user_phone;
      
      //echo "<pre>";print_r($data_array);die; 
    foreach ($data_array as $h){
        //echo "<pre>";print_r($h);die; 
        $varient_id = $h->varient_id;
         $p =  DB::connection('mysql_sec')->table('store_products')
            ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
            ->join('product','product_varient.product_id','=','product.product_id')
            ->Leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
            ->where('product_varient.varient_id',$varient_id)
            ->where('store_products.store_id',$store_id)
            ->first();
            //echo"<pre>";print_r($p);die;
         if($p->deal_price != NULL &&  $p->valid_from < $current && $p->valid_to > $current){
          $price= $p->deal_price;    
        }else{
      $price = $p->price;
        } 
        
        $mrpprice = $p->mrp;
        $order_qty = $h->quantity;
        $price2+= $price*$order_qty;
        $price5+=$mrpprice*$order_qty;
        $unit[] = $p->unit;
        $qty[]= $p->quantity;
        $p_name[] = $p->product_name."(".$p->quantity.$p->unit.")*".$order_qty;
        $prod_name = implode(',',$p_name);
        
    }    
    
    foreach ($data_array as $h)
    { 
        $varient_id = $h->varient_id;
        $p =  DB::connection('mysql_sec')->table('store_products')
            ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
             ->join('product','product_varient.product_id','=','product.product_id')
           ->Leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
           ->where('product_varient.varient_id',$varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
        if($p->deal_price != NULL &&  $p->valid_from < $current && $p->valid_to > $current){
          $price= $p->deal_price;    
        }else{
      $price = $p->price;
        } 
        $mrp = $p->mrp;
        $order_qty = $h->quantity;
        $price1= $price*$order_qty;
        $total_mrp = $mrp*$order_qty;
        $order_qty = $h->qty;
        $p = DB::connection('mysql_sec')->table('store_products')
            ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
             ->join('product','product_varient.product_id','=','product.product_id')
           ->Leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
           ->where('product_varient.varient_id',$varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
       
        $n =$p->product_name;
     

        $insert = DB::connection('mysql_sec')->table('store_orders')
                ->insertGetId([
                        'varient_id'=>$varient_id,
                        'qty'=>$order_qty,
                        'product_name'=>$n,
                        'varient_image'=>$p->varient_image,
                        'quantity'=>$p->quantity,
                        'unit'=>$p->unit,
                        'total_mrp'=>$total_mrp,
                        'order_cart_id'=>$cart_id,
                        'order_date'=>$created_at,
                        'price'=>$price1]);
      
 }
 
 $delcharge=DB::connection('mysql_sec')->table('freedeliverycart')
           ->where('id', 1)
           ->first();
           
if ($delcharge->min_cart_value<=$price2){
    $charge=0;
}  
else{
    $charge =$delcharge->del_charge;
}
 
  if($insert){
        $oo = DB::connection('mysql_sec')->table('orders')
            ->insertGetId(['cart_id'=>$cart_id,
            'total_price'=>$price2 + $charge,
            'price_without_delivery'=>$price2,
            'total_products_mrp'=>$price5,
            'delivery_charge'=>$charge,
            'user_id'=>$user_id,
            'store_id'=>$store_id,
            'rem_price'=>$price2 + $charge,
            'order_date'=> $created_at,
            'delivery_date'=> $delivery_date,
            'time_slot'=>$time_slot,
            'address_id'=>$ar->address_id]); 
                    
           $ordersuccessed = DB::connection('mysql_sec')->table('orders')
                           ->where('order_id',$oo)
                           ->first();
        	$message = array('status'=>'1', 'message'=>'Proceed to payment', 'data'=>$ordersuccessed );
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'insertion failed', 'data'=>[]);
        	return $message;
        }
       
 }
        


 public function checkout(Request $request)
    { 
        $cart_id=$request->cart_id;
        $payment_method= $request->payment_method;
        $payment_status = $request->payment_status;
        $wallet = $request->wallet;
        $orderr = DB::connection('mysql_sec')->table('orders')->where('cart_id', $cart_id)->first(); 
        $store_id = $orderr->store_id;
        $user_id= $orderr->user_id;   
        $delivery_date = $orderr->delivery_date;
        $time_slot= $orderr->time_slot;
        
        $var= DB::connection('mysql_sec')->table('store_orders')->where('order_cart_id', $cart_id)->get();
        $price2 = $orderr->rem_price;
        $ph = DB::connection('mysql_sec')->table('users')->select('user_phone','wallet')->where('user_id',$user_id)->first();
        $user_phone = $ph->user_phone;   
        foreach ($var as $h){
        $varient_id = $h->varient_id;
        $p = DB::connection('mysql_sec')->table('store_orders')->where('order_cart_id',$cart_id)->where('varient_id',$varient_id)->first();
        $price = $p->price; 
        $order_qty = $h->qty;
        $unit[] = $p->unit;
        $qty[]= $p->quantity;
        $p_name[] = $p->product_name."(".$p->quantity.$p->unit.")*".$order_qty;
        $prod_name = implode(',',$p_name);
        }
         $charge = 0;
         $prii = $price2;
        if ($payment_method == 'COD' || $payment_method =='cod'){
             $walletamt = 0;    
            
             $payment_status="COD";
            if($wallet == 'yes' || $wallet == 'Yes' || $wallet == 'YES'){
                echo "in";
             if($ph->wallet >= $prii){
                echo "more in"; die;
                $rem_amount = 0; 
                $walletamt = $prii; 
                $rem_wallet = $ph->wallet-$prii;
                $walupdate = DB::connection('mysql_sec')->table('users')
                           ->where('user_id',$user_id)
                           ->update(['wallet'=>$rem_wallet]);
                $payment_status="success";           
                $payment_method = "wallet";           
             }
             else{
                
                $rem_amount= $prii - $ph->wallet;
                $walletamt = $ph->wallet;
                $rem_wallet = 0;
                $walupdate = DB::connection('mysql_sec')->table('users')
                           ->where('user_id',$user_id)
                           ->update(['wallet'=>$rem_wallet]);
             }
         }
         else{
             $rem_amount=  $prii;
             $walletamt= 0;
         }
       
          $oo = DB::connection('mysql_sec')->table('orders')
           ->where('cart_id',$cart_id)
            ->update([
            'paid_by_wallet'=>$walletamt,
            'rem_price'=>$rem_amount,
            'payment_status'=>$payment_status,
            'payment_method'=>$payment_method
            ]); 
             
            $sms = DB::connection('mysql_sec')->table('notificationby')
                       ->select('sms')
                       ->where('user_id',$user_id)
                       ->first();
            $sms_status = $sms->sms;
            
                if($sms_status == 1){
                    //SUnil : commend due to non-existence function
                    // $orderplacedmsg = $this->ordersuccessfull($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_phone);
                
                }
                      /////send mail
            $email = DB::connection('mysql_sec')->table('notificationby')
                   ->select('email','app')
                   ->where('user_id',$user_id)
                   ->first();

             $q = DB::connection('mysql_sec')->table('users')
                              ->select('user_email','user_name')
                              ->where('user_id',$user_id)
                              ->first();

            $user_email = $q->user_email;             
                 
            $user_name = $q->user_name;       
            $email_status = $email->email;       
            if($email_status == 1){
                   //Sunil : Commented due
                    // $codorderplaced = $this->codorderplacedMail($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_email,$user_name);

               }
             if($email->app ==1){
                  $notification_title = "WooHoo! Your Order is Placed";
                $notification_text = "Order Successfully Placed: Your order id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. " is placed Successfully.You can expect your item(s) will be delivered on ".$delivery_date." between ".$time_slot.".";
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::connection('mysql_sec')->table('users')
                         ->where('user_id', $user_id)
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
                    ->insert(['user_id'=>$user_id,
                     'noti_title'=>$notification_title,
                     'noti_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
             }  
                $orderr1 = DB::connection('mysql_sec')->table('orders')
                       ->where('cart_id', $cart_id)
                       ->first();   
           
                ///////send notification to store//////
              
                $notification_title = "WooHoo ! You Got a New Order";
                $notification_text = "you got an order cart id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. ". It will have to delivered on ".$delivery_date." between ".$time_slot.".";
                
                $date = date('d-m-Y');
                $getUser = DB::connection('mysql_sec')->table('store')
                                ->get();
        
                $getDevice = DB::connection('mysql_sec')->table('store')
                         ->where('store_id', $store_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::connection('mysql_sec')->table('fcm')
                            ->where('id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->store_server_key;
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
                    
                     ///////send notification to store//////
             
                $dd = DB::connection('mysql_sec')->table('store_notification')
                    ->insert(['store_id'=>$store_id,
                     'not_title'=>$notification_title,
                     'not_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
                
           ////rewards earned////
           $checkre =DB::connection('mysql_sec')->table('reward_points')
                    ->where('min_cart_value','<=',$price2)
                    ->orderBy('min_cart_value','desc')
                    ->first();
        if($checkre){             
           $reward_point = $checkre->reward_point;
           
           $inreward = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id)
                     ->update(['rewards'=>$reward_point]);
           
           $cartreward = DB::connection('mysql_sec')->table('cart_rewards')
                     ->insert(['cart_id'=>$cart_id, 'rewards'=>$reward_point, 'user_id'=>$user_id]);
              }  
           
            $message = array('status'=>'1', 'message'=>'Order Placed successfully', 'data'=>$orderr1 );
        	return $message;   
        }
       
        else{
        $walletamt = 0;    
        $prii = $price2 + $charge;
        if($request->wallet == 'yes' || $request->wallet == 'Yes' || $request->wallet == 'YES'){
             if($ph->wallet >= $prii){
                $rem_amount = 0; 
                $walletamt = $prii; 
                $rem_wallet = $ph->wallet - $prii;
                $walupdate = DB::connection('mysql_sec')->table('users')
                           ->where('user_id',$user_id)
                           ->update(['wallet'=>$rem_wallet]);
                $payment_status="success";           
                $payment_method = "wallet";           
             }
             else{
                 
                $rem_amount=  $prii-$ph->wallet;
                $walletamt = $ph->wallet;
                $rem_wallet =0;
                $walupdate = DB::connection('mysql_sec')->table('users')
                           ->where('user_id',$user_id)
                           ->update(['wallet'=>$rem_wallet]);
             }
         }
          else{
              $rem_amount=  $prii;
              $walletamt = 0;
          }
        if($payment_status=='success'){
            $oo = DB::connection('mysql_sec')->table('orders')
           ->where('cart_id',$cart_id)
            ->update([
            'paid_by_wallet'=>$walletamt,
            'rem_price'=>$rem_amount,
            'payment_method'=>$payment_method,
            'payment_status'=>'success'
            ]);  
            $sms = DB::connection('mysql_sec')->table('notificationby')
                       ->select('sms')
                       ->where('user_id',$user_id)
                       ->first();
            $sms_status = $sms->sms;
                if($sms_status == 1){
                $codorderplaced = $this->ordersuccessfull($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_phone);
                }
                      /////send mail
            $email = DB::connection('mysql_sec')->table('notificationby')
                   ->select('email','app')
                   ->where('user_id',$user_id)
                   ->first();
            $email_status = $email->email;
             $q = DB::connection('mysql_sec')->table('users')
                  ->select('user_email','user_name')
                  ->where('user_id',$user_id)
                  ->first();
            $user_email = $q->user_email;     
            $user_name = $q->user_name;
            if($email_status == 1){
                   
                         
                    $orderplaced = $this->orderplacedMail($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_email,$user_name);
               }
            if($email->app == 1){
                  $notification_title = "WooHoo! Your Order is Placed";
                $notification_text = "Order Successfully Placed: Your order id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. " is placed Successfully.You can expect your item(s) will be delivered on ".$delivery_date." between ".$time_slot.".";
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::connection('mysql_sec')->table('users')
                         ->where('user_id', $user_id)
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
                    ->insert(['user_id'=>$user_id,
                     'noti_title'=>$notification_title,
                     'noti_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
             } 
            $orderr1 = DB::connection('mysql_sec')->table('orders')
           ->where('cart_id', $cart_id)
           ->first();
           
              ///////send notification to store//////
              
                $notification_title = "WooHoo ! You Got a New Order";
                $notification_text = "you got an order cart id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. ". It will have to delivered on ".$delivery_date." between ".$time_slot.".";
                
                $date = date('d-m-Y');
                $getUser = DB::connection('mysql_sec')->table('store')
                                ->get();
        
                $getDevice = DB::connection('mysql_sec')->table('store')
                         ->where('store_id', $store_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
     
                $getFcm = DB::connection('mysql_sec')->table('fcm')
                            ->where('id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->store_server_key;
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
                     ///////send notification to store//////
                $dd = DB::connection('mysql_sec')->table('store_notification')
                    ->insert(['store_id'=>$store_id,
                     'not_title'=>$notification_title,
                     'not_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
              ////rewards earned////
           $checkre =DB::connection('mysql_sec')->table('reward_points')
                    ->where('min_cart_value','<=',$price2)
                    ->orderBy('min_cart_value','desc')
                    ->first();
            if($checkre){       
           $reward_point = $checkre->reward_point;
           
           $inreward = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id)
                     ->update(['rewards'=>$reward_point]);
           
           $cartreward = DB::connection('mysql_sec')->table('cart_rewards')
                     ->insert(['cart_id'=>$cart_id, 'rewards'=>$reward_point, 'user_id'=>$user_id]);
            }
            $message = array('status'=>'2', 'message'=>'Order Placed successfully', 'data'=>$orderr1 );
        	return $message; 
         }
         else{
              $oo = DB::connection('mysql_sec')->table('orders')
           ->where('cart_id',$cart_id)
            ->update([
            'paid_by_wallet'=>0,
            'rem_price'=>$rem_amount,
            'payment_method'=>NULL,
            'payment_status'=>'failed'
            ]);  
        	$message = array('status'=>'0', 'message'=>'Payment Failed');
        	return $message;
         }
      }
    }
 
  public function ongoing(Request $request)
  {
      $user = auth('api')->user();
      $user_id = $user->user_id;
      $ongoing = DB::connection('mysql_sec')->table('orders')
             ->leftJoin('delivery_boy', 'orders.dboy_id', '=', 'delivery_boy.dboy_id')
              ->where('orders.user_id',$user_id)
              ->where('orders.order_status', '!=', 'Completed')
              ->where('orders.payment_method', '!=', NULL)
              ->orderBy('orders.order_id', 'DESC')
               ->get();
      
      if(count($ongoing)>0){
      foreach($ongoing as $ongoings){
      $order = DB::connection('mysql_sec')->table('store_orders')
            ->leftJoin('product_varient', 'store_orders.varient_id','=','product_varient.varient_id')
            ->select('store_orders.*','product_varient.description')
            ->where('store_orders.order_cart_id',$ongoings->cart_id)
            ->orderBy('store_orders.order_date', 'DESC')
            ->get();
                  
        
        $data[]=array('order_status'=>$ongoings->order_status, 'delivery_date'=>$ongoings->delivery_date, 'time_slot'=>$ongoings->time_slot,'payment_method'=>$ongoings->payment_method,'payment_status'=>$ongoings->payment_status,'paid_by_wallet'=>$ongoings->paid_by_wallet, 'cart_id'=>$ongoings->cart_id ,'price'=>$ongoings->total_price,'del_charge'=>$ongoings->delivery_charge,'remaining_amount'=>$ongoings->rem_price,'coupon_discount'=>$ongoings->coupon_discount,'dboy_name'=>$ongoings->boy_name,'dboy_phone'=>$ongoings->boy_phone, 'data'=>$order); 
        }
        }
        else{
             $data=array('data'=>[]);
        }
        return $data;       
                  
                  
  }     
  
  
 
 
 
 
  
  
  public function cancel_for(Request $request)
    { 
   $cancelfor = DB::connection('mysql_sec')->table('cancel_for')
                  ->get();
       if($cancelfor){
        	$message = array('status'=>'1', 'message'=>'Cancelling reason list', 'data'=>$cancelfor);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'no list found', 'data'=>[]);
        	return $message;
        }
  }
  
  
  public function delete_order(Request $request)
  {
      $cart_id = $request->cart_id;
       $user = DB::connection('mysql_sec')->table('orders')
              ->where('cart_id',$cart_id)
              ->first();
        $user_id1 = $user->user_id;
         $userwa1 = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id1)
                     ->first();
      $reason = $request->reason;
      $order_status = 'Cancelled';
      $updated_at = Carbon::now();
      $order = DB::connection('mysql_sec')->table('orders')
                  ->where('cart_id', $cart_id)
                  ->update([
                        'cancelling_reason'=>$reason,
                        'order_status'=>$order_status,
                        'updated_at'=>$updated_at]);
      
       if($order){
        if($user->payment_method == 'COD' || $user->payment_method == 'Cod' || $user->payment_method == 'cod'){
            $newbal1 = $userwa1->wallet + $user->paid_by_wallet;  
              }
          else{
              if($user->payment_status=='success'){
                  $newbal1 = $userwa1->wallet + $user->rem_price + $user->paid_by_wallet;
              }
              else{
                   $newbal1 = $userwa1->wallet;     
              }
             }                 
           $userwalletupdate = DB::connection('mysql_sec')->table('users')
             ->where('user_id',$user_id1)
             ->update(['wallet'=>$newbal1]);  
        	$message = array('status'=>'1', 'message'=>'order cancelled', 'data'=>$order);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }
      
      
  }   
  

  
   public function top_selling(Request $request){
       $current = Carbon::now();
       $lat = $request->lat;
       $lng = $request->lng;
        $cityname = $request->city;
       $city = ucfirst($cityname);
       $nearbystore = DB::connection('mysql_sec')->table('store')
                    ->select('del_range','store_id',DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(store.lat)) 
                    * cos(radians(store.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(store.lat))) AS distance"))
                  ->where('store.del_range','>=','distance')
                  ->orderBy('distance')
                  ->first();
 if($nearbystore){  
if($nearbystore->del_range >= $nearbystore->distance) {               
      $topselling = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                  ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                  ->Leftjoin ('store_orders', 'store_products.varient_id', '=', 'store_orders.varient_id') 
                  ->Leftjoin ('orders', 'store_orders.order_cart_id', '=', 'orders.cart_id')
                  ->Leftjoin ('deal_product', 'product_varient.varient_id', '=', 'deal_product.varient_id')
                  ->select('store_products.store_id','store_products.stock','product_varient.varient_id','product.product_id','product.product_name', 'product.product_image', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity',DB::connection('mysql_sec')->raw('count(store_orders.varient_id) as count'))
                  ->groupBy('store_products.store_id','store_products.stock','product_varient.varient_id','product.product_id','product.product_name', 'product.product_image', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity')
                  ->where('store_products.store_id', $nearbystore->store_id)
                  ->where('deal_product.deal_price', NULL)
                  ->where('store_products.price','!=',NULL)
                  ->where('product.hide',0)
                  ->orderBy('count','desc')
                  ->limit(10)
                  ->get();
                  
         if(count($topselling)>0){
        	$message = array('status'=>'1', 'message'=>'top selling products', 'data'=>$topselling);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'nothing in top', 'data'=>[]);
        	return $message;
        }      
      }
       else{
           $message = array('status'=>'2', 'message'=>'No Products Found Nearby', 'data'=>[]);
            return $message; 
       }
          } 
       else{
           $message = array('status'=>'2', 'message'=>'No Products Found Nearby', 'data'=>[]);
            return $message; 
       }
     
  }    
  
  
  
  
    public function whatsnew(Request $request){
      $current = Carbon::now(); 
      $lat = $request->lat;
      $lng = $request->lng;
      $cityname = $request->city;
      $city = ucfirst($cityname);
      $nearbystore = DB::connection('mysql_sec')->table('store')
                    ->select('del_range','store_id',DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(store.lat)) 
                    * cos(radians(store.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(store.lat))) AS distance"))
                  ->where('store.del_range','>=','distance')
                  ->orderBy('distance')
                  ->first();
     if($nearbystore){  
       if($nearbystore->del_range >= $nearbystore->distance) {               
      $new = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                  ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                  ->Leftjoin ('deal_product', 'product_varient.varient_id', '=', 'deal_product.varient_id')
                  ->select('store_products.store_id','store_products.stock','product_varient.varient_id','product.product_id','product.product_name', 'product.product_image', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity')
                  ->limit(10)
                   ->where('store_products.store_id', $nearbystore->store_id)
                  ->where('deal_product.deal_price', NULL)
                ->where('store_products.price','!=',NULL)
                ->where('product.hide',0)
                  ->orderByRaw('RAND()')
                  ->get();
                  
         if(count($new)>0){
        	$message = array('status'=>'1', 'message'=>'New in App', 'data'=>$new);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'nothing in new', 'data'=>[]);
        	return $message;
        }      
    }
       else{
           $message = array('status'=>'2', 'message'=>'No Products Found Nearby', 'data'=>[]);
            return $message; 
       }
         } 
       else{
           $message = array('status'=>'2', 'message'=>'No Products Found Nearby', 'data'=>[]);
            return $message; 
       }
  }    
  
  
  
    public function recentselling(Request $request){
        $current = Carbon::now();    
          $lat = $request->lat;
       $lng = $request->lng;
       $cityname = $request->city;
       $city = ucfirst($cityname);
       $nearbystore = DB::connection('mysql_sec')->table('store')
                    ->select('del_range','store_id',DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(store.lat)) 
                    * cos(radians(store.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(store.lat))) AS distance"))
                  ->where('store.del_range','>=','distance')
                  ->orderBy('distance')
                  ->first();
    if($nearbystore){              
      if($nearbystore->del_range >= $nearbystore->distance) {               
      $recentselling = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                  ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                  ->Leftjoin ('store_orders', 'product_varient.varient_id', '=', 'store_orders.varient_id') 
                  ->Leftjoin ('orders', 'store_orders.order_cart_id', '=', 'orders.cart_id')
                  ->Leftjoin ('deal_product', 'product_varient.varient_id', '=', 'deal_product.varient_id')
                  ->select('store_products.store_id','store_products.stock','product_varient.varient_id','product.product_id','product.product_name', 'product.product_image', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity',DB::connection('mysql_sec')->raw('count(store_orders.varient_id) as count'))
                  ->groupBy('store_products.store_id','store_products.stock','product_varient.varient_id','product.product_id','product.product_name', 'product.product_image', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity')
                   ->where('store_products.store_id', $nearbystore->store_id)
                  ->orderByRaw('RAND()')
                  ->where('deal_product.deal_price', NULL)
                  ->where('product.hide',0)
                ->where('store_products.price','!=',NULL)
                  ->limit(10)
                  ->get();
                  
         if(count($recentselling)>0){
        	$message = array('status'=>'1', 'message'=>'recent selling products', 'data'=>$recentselling);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'nothing in top', 'data'=>[]);
        	return $message;
        } 
     }
       else{
           $message = array('status'=>'2', 'message'=>'No Products Found Nearby', 'data'=>[]);
            return $message; 
       }
       }
       else{
           $message = array('status'=>'2', 'message'=>'No Products Found Nearby', 'data'=>[]);
            return $message; 
       }
  }    
  
  
  
  
   public function completed_orders(Request $request)
    {
      $user = auth('api')->user();
      $user_id = $user->user_id;
      $completeds = DB::connection('mysql_sec')->table('orders')
               ->leftJoin('delivery_boy', 'orders.dboy_id', '=', 'delivery_boy.dboy_id')
              ->where('orders.user_id',$user_id)
              ->where('orders.order_status', 'Completed')
              ->get();
      
      if(count($completeds)>0){
      foreach($completeds as $completed){
      $order = DB::connection('mysql_sec')->table('store_orders')
              ->leftJoin('product_varient', 'store_orders.varient_id','=','product_varient.varient_id')
              ->select('store_orders.*','product_varient.description')
              ->where('store_orders.order_cart_id',$completed->cart_id)
              ->orderBy('store_orders.order_date', 'DESC')
              ->get();
                  
        
        $data[]=array('order_status'=>$completed->order_status, 'delivery_date'=>$completed->delivery_date, 'time_slot'=>$completed->time_slot,'payment_method'=>$completed->payment_method,'payment_status'=>$completed->payment_status,'paid_by_wallet'=>$completed->paid_by_wallet, 'cart_id'=>$completed->cart_id ,'price'=>$completed->total_price,'del_charge'=>$completed->delivery_charge,'remaining_amount'=>$completed->rem_price,'coupon_discount'=>$completed->coupon_discount,'dboy_name'=>$completed->boy_name,'dboy_phone'=>$completed->boy_phone, 'data'=>$order); 
        }
        }
        else{
            $data=array('data'=>[]);
        }
        return $data;       
                  
                  
  }     
  
  
  
  
   public function can_orders(Request $request)
    {
      $user = Jauth('api')->user();
      $user_id = $user->user_id;
      $completed = DB::connection('mysql_sec')->table('orders')
              ->where('user_id',$user_id)
              ->where('order_status', 'cancelled')
               ->get();
      
      if(count($completed)>0){
      foreach($completed as $completeds){
      $order = DB::connection('mysql_sec')->table('store_orders')
            ->join ('product_varient', 'store_orders.varient_id', '=', 'product_varient.varient_id')
            ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                  ->select('product_varient.varient_id','product.product_name', 'product_varient.varient_image','store_orders.qty','product_varient.description','product_varient.unit','product_varient.quantity','store_orders.order_cart_id')
                  ->where('store_orders.order_cart_id',$completeds->cart_id)
                  ->groupBy('product_varient.varient_id','product.product_name', 'product_varient.varient_image','store_orders.qty','product_varient.description','product_varient.unit','product_varient.quantity','store_orders.order_cart_id')
                  ->orderBy('store_orders.order_date', 'DESC')
                  ->get();
                  
        
        $data[]=array( 'cart_id'=>$completeds->cart_id ,'price'=>$completeds->total_price,'del_charge'=>$completeds->delivery_charge, 'data'=>$order); 
        }
        }
        else{
            $data[]=array('data'=>'No Orders Cancelled Yet');
        }
        return $data;       
                  
                  
  }     
  
  public function createOrder(Request $request){
    $validation = Validator::make($request->all(), [
        //'user_id' => 'required',
        'store_id' => 'required',
        'address_id' => 'required',
        'payment_method' => 'required',
        'delivery_date' => 'nullable',
        'time_slot' => 'nullable',
        'timeslot_delivery_date' => 'required',
        // 'total_products_mrp' => 'required',
        // 'final_price' => 'required',
        // 'total_price' => 'required',
        // 'total_items' => 'required',
    ]);
    if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
    }
    $store_id = $request->store_id;
    $address_id = $request->address_id;
    $user = auth('api')->user();
    $user_id = $user->user_id;

    $tax = env('TaxtRate') ? env('TaxtRate') : 0;
    $final_price = 0;
    $total_discount = 0;
    $mrp_price=0;
    $total_items = 0;
    $delivery_charges = 0;
    $min_cart_value =0;
    $del_charge =0;
    $distance =0;

    $delcharge   = DB::connection('mysql_sec')->table('freedeliverycart')->first();
    $address     = DB::connection('mysql_sec')->table('address')->where('address_id',$address_id)->first();
    $store       = DB::connection('mysql_sec')->table('store')->where('store_id',$store_id)->first();
    $distance    = $this->distance($address->lat,$address->lng,$store->lat,$store->lng,'K');

    $cartItems = DB::connection('mysql_sec')->table('cart_items')
        ->where(['user_id'=>$user_id,'store_id'=>$request->store_id])->get();
    $total_items = count($cartItems);
    if(count($cartItems)>0){
        foreach ($cartItems as $key => $row) {
            $final_price += $row->quantity * $row->final_price;
            $mrp_price += $row->quantity * $row->price;
            $total_discount += $row->quantity * $row->total_discount;
        }
        
    }

    //$user = JWTAuth::toUser($request->token);
    //$user    = DB::connection('mysql_sec')->table('users')->where('user_id',$user_id)->first();
    //$check   = DB::connection('mysql_sec')->table('freedeliverycart')->first();
    //$address = DB::connection('mysql_sec')->table('address')->where('address_id',$request->address_id)->first();
    //$store   = DB::connection('mysql_sec')->table('store')->where('store_id',$request->store_id)->first();
    //$distance = $this->distance($address->lat,$address->lng,$store->lat,$store->lng,'K');

    // if($check){
    //    $min_cart_value = $check->min_cart_value;
    //    $del_charge = $check->del_charge;
    // }

    // if($final_price > $min_cart_value){
    //     $delivery_charges = 0;
    // }else{
    //     $delivery_charges = $distance* $del_charge;
    // }

    // $data['subtotal'] = [
    //     'mrp_price'=>$mrp_price,
    //     'final_price'=>$final_price,
    //     'discount_amount'=>$total_discount,
    //     'total_items'=>$total_items,
    //     'total_price'=>$final_price +$delivery_charges,
    //     'delivery_charges'=>$delivery_charges,
    // ];

    $total_price = $final_price + $delivery_charges;
    $data = $request->all();

    if($delcharge){
       $min_cart_value = $delcharge->min_cart_value;
       $del_charge = $delcharge->del_charge;
    }

    if($final_price > $min_cart_value){
        $data['delivery_charge_km'] = 0;
        $data['delivery_distance'] = $distance;
        $delivery_charges = 0;
    }else{
        $data['delivery_charge_km'] = $del_charge;
        $data['delivery_distance'] = $distance;
        $delivery_charges = $distance* $del_charge;
    }

    $data['timeslot_delivery_date'] =date($request->timeslot_delivery_date);
    //echo"<pre>";print_r($data);die;
    $data['discount_amount'] = $total_discount;
    $data['total_products_mrp'] = $mrp_price;
    $data['delivery_charge'] = $delivery_charges;
    $data['total_price'] = $total_price+($tax/100*$total_price);
    $data['total_items'] = $total_items;
    $data['price_without_delivery'] = $final_price;
    //$data['total_price']   = $data['total_price'];
    $data['cart_id']     = uniqid();
    $data['order_status']  = 1;
    $data['payment_status']  = 1;
    $data['order_date']  = now();
    // $pay = array();
    if($request->payment_method ==2){
      $data['order_status']    = 1;
      $data['payment_status']  = 2;
      // $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
      // $razorder  = $api->order->create(array('receipt' =>uniqid(), 'amount' =>$data['total_price'], 'currency' => env('RAZOR_CURRENCY')));

      // $data['razorpay_order_id']  =$razorder->id;

      // $pay['razor_order_id'] = $razorder->id;
      // $pay['payableamount']       = $data['total_price'];
      // $pay['user_name']    = $user->user_name;
      // $pay['phone']        = $user->user_phone;
      // $pay['currency']     = env('RAZOR_CURRENCY');
      // $pay['razor_key']    = env('RAZOR_KEY');
    }
    $data['user_id']= $user_id;
    $data['tax']= $tax;

    $order = DB::connection('mysql_sec')->table('orders')->insertGetId($data);
    if($order){
        $data['order_id']=$order;
        // $data['online_payment'] = (object)$pay;
        $cartItems = DB::connection('mysql_sec')->table('cart_items')->where('user_id',$user_id)->get();
        foreach ($cartItems as $item) {
          $orderItem['order_id'] =$order;
          $orderItem['product_id'] =$item->product_id;
          $orderItem['varient_id'] =$item->varient_id;
          $orderItem['user_id'] =$item->user_id;
          $orderItem['store_id'] =$item->store_id;
          $orderItem['total_discount'] =$item->total_discount;
          $orderItem['price'] =$item->price;
          $orderItem['final_price'] =$item->final_price;
          $orderItem['product_name'] =$item->product_name;
          $orderItem['product_description'] =$item->product_description;
          $orderItem['quantity'] =$item->quantity;
          $orderItem['unit'] =$item->unit;
          $orderItem['store_discount_type'] =$item->store_discount_type;
          DB::connection('mysql_sec')->table('order_items')->insert($orderItem);
          if($request->payment_method ==1){
            $st = DB::connection('mysql_sec')->table('store_products')
            ->where(['varient_id'=>$item->varient_id,'store_id'=>$item->store_id])->first();
            $s_data['stock'] = $st->stock - $item->quantity;
            DB::connection('mysql_sec')->table('store_products')
            ->where(['varient_id'=>$item->varient_id,'store_id'=>$item->store_id])->update($s_data);
          }
        }

        if($request->payment_method ==1){
          DB::connection('mysql_sec')->table('cart_items')->where(['user_id'=>$user_id,'store_id'=>$store_id])->delete();
          storeNoctification('New Order','You Have Received New Order',$store_id);
          userNoctification('New Order','Your Order Place Successfully',$user_id);
          addActivityLog('New Order',$user_id,5);
        }

        if(isset($request->time_slot)){
            $time_id =$request->time_slot;
            $time =  DB::connection('mysql_sec')->table('store_time_slot')
                    ->where(['id'=>$time_id])->first();
            $data['time_slot']=$time->opening_time.' - '.$time->closing_time;
        }
        return apiResponse(true,200,$data);
    }else{
        return apiResponse(false,422,'Something Wrong');
    }
  }

  public function onlinePayment(Request $request){
    $validation = Validator::make($request->all(), [
        'order_id' => 'required',
       //'user_id' => 'required',
    ]);

    if($validation->fails()) {
      return apiResponse(false,406,$validation->getMessageBag());
    }
    $pay =array();
    $user = auth('api')->user();
    //$user = DB::connection('mysql_sec')->table('orders')->where('order_id',$request->order_id)->first();
    $order = DB::connection('mysql_sec')->table('orders')->where('order_id',$request->order_id)->first();
    $time_id =$order->time_slot;
    $time =  DB::connection('mysql_sec')->table('store_time_slot')
            ->where(['id'=>$time_id])->first();
    $order->time_slot = $time->opening_time.' - '.$time->closing_time;

    //echo"<pre>";print_r($order);die;
    $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
    $razorder  = $api->order->create(array('receipt' => $request->order_id, 'amount' =>$order->total_price*100, 'currency' => env('RAZOR_CURRENCY')));
    $data['razorpay_order_id']  = $razorder->id;
    $order->razorpay_order_id   = $razorder->id;
    DB::connection('mysql_sec')->table('orders')->where('order_id',$request->order_id)->update($data);
    $pay['order_id']    = $order->order_id;
    $pay['store_id']    = $order->store_id;
    $pay['razor_order_id'] = $razorder->id;
    $pay['amount']       = $order->total_price;
    $pay['user_name']    = $user->user_name;
    $pay['phone']        = $user->user_phone;
    $pay['currency']     = env('RAZOR_CURRENCY');
    $pay['razor_key']    = env('RAZOR_KEY');
    $order->online_payment = (object)$pay;
    return apiResponse(true,200,$order);
  }

  public function thanksForOrder(Request $request){
        $validation = Validator::make($request->all(), [
          'order_id' => 'required',
      ]);

      if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
      }
      $orders  = DB::connection('mysql_sec')->table('orders')->where('order_id',$request->order_id)->first();

        $time_id =$orders->time_slot;
        $time =  DB::connection('mysql_sec')->table('store_time_slot')
            ->where(['id'=>$time_id])->first();
        $order->time_slot = $time->opening_time.' - '.$time->closing_time;

      $address = DB::connection('mysql_sec')->table('address')->where('address_id',$orders->address_id)->first();
      $orders->address =$address;
      return apiResponse(true,200,$orders);
  }

  public function successPayment(Request $request){
       $validation = Validator::make($request->all(), [
          'razorpay_order_id' => 'required',
          'razorpay_signature' => 'required',
          'store_id' => 'required',
          'order_id' => 'required',
      ]);

      if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
      }
      $data =array(
        'razorpay_order_id'=>$request->razorpay_order_id,
        'payment_status'=>2,
      );
      DB::connection('mysql_sec')->table('orders')->where('razorpay_order_id',$request->razorpay_order_id)->update($data);
      $order = DB::connection('mysql_sec')->table('orders')->where('razorpay_order_id',$request->razorpay_order_id)->first();
        $time_id =$order->time_slot;
        $time =  DB::connection('mysql_sec')->table('store_time_slot')
            ->where(['id'=>$time_id])->first();
        $order->time_slot = $time->opening_time.' - '.$time->closing_time;
        // $user = JWTAuth::toUser($request->token);
        // $user_id = $user->user_id;
        $user_id = $order->user_id;
        $order_id = $order->order_id;
        $store_id = $order->store_id;
        $orderItems = DB::connection('mysql_sec')->table('order_items')->where('order_id',$order_id)->get();
        foreach ($orderItems as $item) {
          $st = DB::connection('mysql_sec')->table('store_products')
          ->where(['varient_id'=>$item->varient_id,'store_id'=>$item->store_id])->first();
          $s_data['stock'] = $st->stock - $item->quantity;
          DB::connection('mysql_sec')->table('store_products')
          ->where(['varient_id'=>$item->varient_id,'store_id'=>$item->store_id])->update($s_data);
        }
        storeNoctification('New Order','You Have Received New Order',$store_id);
        userNoctification('New Order','Your Order Place Successfully',$user_id);
        addActivityLog('New Order',$user_id,5);

        DB::connection('mysql_sec')->table('cart_items')->where(['user_id'=>$user_id,'store_id'=>$store_id])->delete();
    return apiResponse(true,200,$order);
  }

  public function cancelReason(Request $request){
    $reason = DB::connection('mysql_sec')->table('cancel_for')->get();
    return apiResponse(true,202,$reason);
  }
  public function cancelOrder(Request $request){
        $validation = Validator::make($request->all(), [
          'order_id' => 'required',
          'cancelling_reason' => 'required',
      ]);

      if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
      }

      $user = auth('api')->user();
      $user_id = $user->user_id;
      $cancelling_reason = $request->cancelling_reason;
      $order_id = $request->order_id;

      $orders = DB::connection('mysql_sec')->table('orders')
      ->where('order_id',$order_id)->update(['order_status'=>0,'cancelling_reason'=>$cancelling_reason]);

      userNoctification('New Order','Your Order Successfully Canceled',$user_id);

      addActivityLog('cancel order',$user_id,5);

       return apiResponse(true,204,'Your Order Successfully Canceled');
  }

  public function OrderList(Request $request){
    // $validation = Validator::make($request->all(), [
    //     'user_id' => 'required',
    // ]);
    // if($validation->fails()) {
    //   return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
    // }
    $user = auth('api')->user();
    $user_id = $user->user_id;
    $orders = DB::connection('mysql_sec')->table('orders')
    ->where('user_id',$user_id)->orderBy('order_id', 'DESC')->get();
    foreach($orders as $order){
        $time_id =$order->time_slot;
        $time =  DB::connection('mysql_sec')->table('store_time_slot')
                ->where(['id'=>$time_id])->first();
        if($time){
            $order->time_slot = $time->opening_time.' - '.$time->closing_time;
        }
    }
    return apiResponse(true,202,$orders);
  } 

  public function OrderDetails(Request $request){
    $validation = Validator::make($request->all(), [
        'order_id' => 'required',
    ]);
    if($validation->fails()) {
      return apiResponse(false,406,$validation->getMessageBag());
    }

    $orders  = DB::connection('mysql_sec')->table('orders')->where('order_id',$request->order_id)->first();
    $time_id =$orders->time_slot;
    $time =  DB::connection('mysql_sec')->table('store_time_slot')
            ->where(['id'=>$time_id])->first();
    //echo"<pre>";print_r($time);die;
    $orders->time_slot = $time->opening_time.' - '.$time->closing_time;
    $address = DB::connection('mysql_sec')->table('address')->where('address_id',$orders->address_id)->first();
    if($orders){
      $orderItem = DB::connection('mysql_sec')->table('order_items')->where('order_id',$request->order_id)->get();
      foreach ($orderItem as $item) {
      	$item->product_image =DB::table('product')->where('product_id',$item->product_id)->value('product_image');
      }
      $orders->items = $orderItem;
      $orders->address = $address;
    }
     return apiResponse(true,200,$orders);
  }

  function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
      return 0;
    }
    else {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);

      if ($unit == "K") {
          $dis = $miles * 1.609344;
          return number_format($dis,2);
      } else if ($unit == "N") {
          $dis = $miles * 0.8684;
          return number_format($dis,2);
      } else {
        return number_format($miles,2);
      }
    }
  }

}