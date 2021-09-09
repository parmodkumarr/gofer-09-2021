<?php

namespace App\Http\Controllers\Storeapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Traits\SendSms;
use Validator;
class StoreorderController extends Controller
{
use SendSms;
 public function nextdayorders(Request $request)
     {
        $validation = Validator::make($request->all(), [
                'store_id' => 'required'
        ]);
        if($validation->fails()) {
            return array('status'=>442,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        }
         $date = date('Y-m-d');
         $day = 1;
         $next_date = date('Y-m-d', strtotime($date.' + '.$day.' days'));
         $store_id  = $request->store_id;
         $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('store_id',$store_id)
    	 		   ->first();
    	 		   
        $ord =DB::connection('mysql_sec')->table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->leftJoin('address','orders.address_id','=','address.address_id')
			 ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
             ->select('orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','orders.order_status','orders.payment_method','users.user_phone','address.*')
             ->where('orders.store_id',$store_id)
             ->where('payment_method', '!=', NULL)
             ->where('orders.delivery_date',$next_date)
             ->where('orders.order_status','!=',0)
             ->get();
       
       if(count($ord)>0){
      foreach($ord as $ords){
             $cart_id = $ords->cart_id;    
         $details  =   DB::connection('mysql_sec')->table('store_orders')
    	               ->where('order_cart_id',$cart_id)
    	               ->where('store_approval',1)
    	               ->get(); 
                  
        
        $data[]=array('user_address'=>$ords->house_no.','.$ords->society.','.$ords->city.','.$ords->landmark.','.$ords->state.','.$ords->pincode, 'cart_id'=>$cart_id,'user_name'=>$ords->user_name, 'user_phone'=>$ords->user_phone, 
        'remaining_price'=>$ords->rem_price,'order_price'=>$ords->total_price,'delivery_boy_name'=>$ords->boy_name,'delivery_boy_phone'=>$ords->boy_phone,'delivery_date'=>$ords->delivery_date,'time_slot'=>$ords->time_slot,'payment_mode'=>$ords->payment_method,  'payment_status'=>$ords->payment_status,'order_status'=>$ords->order_status, 'customer_phone'    =>$ords->user_phone,'order_details'=>$details); 
        }
        }
        else{
            $data[]=array('order_details'=>'no orders found');
        }
        return array('status'=>200,'message'=>'success','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$data);   
    }          
    
    
    public function todayorders(Request $request){
      $validation = Validator::make($request->all(), [
                'store_id' => 'required'
        ]);
        if($validation->fails()) {
            return array('status'=>442,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        }
         $date = date('Y-m-d');
         $store_id = $request->store_id;
         $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('store_id',$store_id)
    	 		   ->first();
    	 		   
        $ord =DB::connection('mysql_sec')->table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->leftJoin('address','orders.address_id','=','address.address_id')
             ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
             ->select('orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','orders.order_status','orders.payment_method','users.user_phone','address.*')
             ->where('orders.store_id',$store_id)
			       ->where('orders.delivery_date', $date)
             ->where('payment_method', '!=', NULL)
             ->where('orders.order_status','!=',0)
              ->orWhere('orders.order_status','!=',4)
   //           ->where('payment_method', '!=', NULL)
   //            ->where('orders.order_status','!=','cancelled')
			// ->where('orders.order_status','!=','Completed')
			// ->orderByRaw("FIELD(order_status , 'Pending', 'Confirmed', 'Out_For_Delivery', 'Completed') ASC")
             ->get();
       
       if(count($ord)>0){
      foreach($ord as $ords){
             $cart_id = $ords->cart_id;    
         $details  =   DB::connection('mysql_sec')->table('store_orders')
    	               ->where('order_cart_id',$cart_id)
    	               ->where('store_approval',1)
    	               ->get(); 
                  
        
        $data[]=array('user_address'=>$ords->house_no.','.$ords->society.','.$ords->city.','.$ords->landmark.','.$ords->state.','.$ords->pincode, 'cart_id'=>$cart_id,'user_name'=>$ords->user_name, 'user_phone'=>$ords->user_phone, 
        'remaining_price'=>$ords->rem_price,'order_price'=>$ords->total_price,'delivery_boy_name'=>$ords->boy_name,'delivery_boy_phone'=>$ords->boy_phone,'delivery_date'=>$ords->delivery_date,'time_slot'=>$ords->time_slot,'payment_mode'=>$ords->payment_method, 'payment_status'=>$ords->payment_status,'order_status'=>$ords->order_status, 'customer_phone'    =>$ords->user_phone,'order_details'=>$details); 
        }
        }
        else{
            $data[]=array('order_details'=>'no orders found');
        }
        return array('status'=>200,'message'=>'success','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$data);
        //return $data;     
    }      
            
  public function productcancelled(Request $request)
    {
       $id= $request->store_order_id;
       $cart = DB::connection('mysql_sec')->table('store_orders')
            ->select('order_cart_id','varient_id','qty')
            ->where('store_order_id', $id)
            ->first();
          $curr = DB::connection('mysql_sec')->table('currency')
            ->first();
      $cart_id = $cart->order_cart_id;
      $st = DB::connection('mysql_sec')->table('orders')
            ->where('cart_id',$cart_id)
            ->first();	
		$store_id = $st->store_id;
      $var = DB::connection('mysql_sec')->table('store_orders')
    ->where('order_cart_id', $cart_id)
    ->get();
       $price2 = 0;
     
     foreach ($var as $h){
        $varient_id = $h->varient_id;
         $p = DB::connection('mysql_sec')->table('store_products')
            ->join('product_varient','store_products.varient_id','=','product_varient.varient_id') 
            ->join('product','product_varient.product_id','=','product.product_id')
           ->where('store_products.varient_id',$varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
        $price = $p->price;
        $mrpprice = $p->mrp;
        $order_qty = $h->qty;
        $price2+= $price*$order_qty;
        $unit[] = $p->unit;
        $qty[]= $p->quantity;
        $p_name[] = $p->product_name."(".$p->quantity.$p->unit.")*".$order_qty;
        $prod_name = implode(',',$p_name);
        }    
       $v = DB::connection('mysql_sec')->table('store_products')
            ->join('product_varient','store_products.varient_id','=','product_varient.varient_id') 
            ->join('product','product_varient.product_id','=','product.product_id')
           ->where('store_products.varient_id',$varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
       
       $v_price =$v->price * $cart->qty;       
      $ordr = DB::connection('mysql_sec')->table('orders')
            ->where('cart_id', $cart->order_cart_id)
            ->first();
       $user_id = $ordr->user_id;
       $userwa = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id)
                     ->first();
     if($ordr->payment_method == 'COD' || $ordr->payment_method == 'Cod' || $ordr->payment_method == 'cod'){          
        $newbal = $userwa->wallet;   
      }
      else{
        $newbal = $userwa->wallet + $v_price;  
      }             
       $orders = DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart->order_cart_id)
            ->where('store_approval',1)
            ->get();   
       
        if(count($orders)==1 || count($orders)==0){
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
   
    
            $cancel=2;
             $ordupdate = DB::connection('mysql_sec')->table('orders')
                     ->where('cart_id', $cart->order_cart_id)
                     ->update(['store_id'=>0,
                     'cancel_by_store'=>$cancel]);
             $carte= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart->order_cart_id)
            ->where('store_approval',0)
            ->get();
            
            foreach($carte as $carts){
                $v1 = DB::connection('mysql_sec')->table('store_products')
            ->join('product_varient','store_products.varient_id','=','product_varient.varient_id') 
            ->join('product','product_varient.product_id','=','product.product_id')
           ->where('store_products.varient_id',$varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
               
               $v_price1 =$v1->price * $carts->qty;       
               $ordr1 = DB::connection('mysql_sec')->table('orders')
                    ->where('cart_id', $carts->order_cart_id)
                    ->first();
               $user_id1 = $ordr1->user_id;
               $userwa1 = DB::connection('mysql_sec')->table('users')
                             ->where('user_id',$user_id1)
                             ->first();
                $newbal1 = $userwa1->wallet - $v_price1;
                 $userwalletupdate = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id1)
                     ->update(['wallet'=>$newbal1]);
            }    
            
            $cart_update= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart->order_cart_id)
            ->update(['store_approval'=>1]);
        $data[]=array('result'=>'order cancelled successfully');
       
         
        }    
            
        else{    
       $cancel_product = DB::connection('mysql_sec')->table('store_orders')
                       ->where('store_order_id', $id)
                       ->update(['store_approval'=>0]);
         $userwallet = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id)
                     ->update(['wallet'=>$newbal]);
         $data[]=array('result'=>'product cancelled successfully');                  
                       
        }             
       return $data;            
    }





    public function order_rejected(Request $request)
    {
       $cart_id= $request->cart_id;
       $store_id = $request->store_id;
       
      $ordr = DB::connection('mysql_sec')->table('orders')
            ->where('cart_id', $cart_id)
            ->first();
        $curr = DB::connection('mysql_sec')->table('currency')
             ->first();
       $orders = DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->where('store_approval',1)
            ->get(); 
         $var = DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->where('store_approval',1)
            ->get();        
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('store_id',$store_id)
    	 		   ->first();
    	             
        $v_price1 = 0;
        $cartss= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->where('store_approval',0)
            ->get();
            
      if(count($cartss)>0){
          foreach($cartss as $carts){
                $v1 = DB::connection('mysql_sec')->table('store_orders')
               ->where('store_order_id', $carts->store_order_id)
               ->first();
               
               $v_price1 += $v1->price * $v1->qty;       
              
            }      
         $user_id1 = $ordr->user_id;
         $userwa1 = DB::connection('mysql_sec')->table('users')
                     ->where('user_id',$user_id1)
                     ->first();
       if($ordr->payment_method == 'COD' || $ordr->payment_method == 'Cod' || $ordr->payment_method == 'cod'){
            $newbal1 = $userwa1->wallet;   
          }
          else{
            $newbal1 = $userwa1->wallet - $v_price1;
          }                 
         $userwalletupdate = DB::connection('mysql_sec')->table('users')
             ->where('user_id',$user_id1)
             ->update(['wallet'=>$newbal1]);
       }     		   
    	 		   
    	 		   
        $price2 = 0;     
       foreach ($var as $h){
        $varient_id = $h->varient_id;
       $p = DB::connection('mysql_sec')->table('store_products')
            ->join('product_varient','store_products.varient_id','=','product_varient.varient_id') 
            ->join('product','product_varient.product_id','=','product.product_id')
           ->where('store_products.varient_id',$varient_id)
           ->where('store_products.store_id',$store_id)
           ->first();
        $price = $p->price;   
        $order_qty = $h->qty;
        $price2+= $price*$order_qty;
        $unit[] = $p->unit;
        $qty[]= $p->quantity;
        $p_name[] = $p->product_name."(".$p->quantity.$p->unit.")*".$order_qty;
        $prod_name = implode(',',$p_name);
        }
               
         if($ordr->cancel_by_store==0){
            $cancel=1;
          $store_id = DB::connection('mysql_sec')->table('store')
              ->select("store_id","store_name"
            ,DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$store->lat . ")) 
            * cos(radians(lat)) 
            * cos(radians(lng) - radians(" . $store->lng . ")) 
            + sin(radians(" .$store->lat. ")) 
            * sin(radians(lat))) AS distance"))
           ->where('city',$store->city) 
           ->where('store_id','!=',$store->store_id)
           ->orderBy('distance')
           ->first();
            if($store_id){
            $ordupdate = DB::connection('mysql_sec')->table('orders')
                     ->where('cart_id', $cart_id)
                     ->update(['store_id'=>$store_id->store_id,
                     'cancel_by_store'=>$cancel]);
             $carte= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->where('store_approval',0)
            ->get();
            $cart_update= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->update(['store_approval'=>1]);
            
              ///////send notification to store//////
              
                $notification_title = "WooHoo ! You Got a New Order";
                $notification_text = "you got an order cart id #".$cart_id." contains of " .$prod_name." of price ".$curr->currency_sign." ".$price2. ". It will have to delivered on ".$ordr->delivery_date." between ".$ordr->time_slot.".";
                
                $date = date('d-m-Y');
                $getUser = DB::connection('mysql_sec')->table('store')
                                ->get();
        
                $getDevice = DB::connection('mysql_sec')->table('store')
                         ->where('store_id', $store_id->store_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                
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
                    ->insert(['store_id'=>$store_id->store_id,
                     'not_title'=>$notification_title,
                     'not_message'=>$notification_text]);
                    
                $results = json_decode($result);
            $data[]=array('result'=>'Order Rejected successfully');
            }
            else{
            $ordupdate = DB::connection('mysql_sec')->table('orders')
                     ->where('cart_id', $cart_id)
                     ->update(['store_id'=>0,
                     'cancel_by_store'=>$cancel]);
            
             $carte= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->where('store_approval',0)
            ->get();
            $cart_update= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->update(['store_approval'=>1]); 
            $data[]=array('result'=>'Order Rejected successfully');
            }
        }
        else{
            $cancel=2;
             $ordupdate = DB::connection('mysql_sec')->table('orders')
                     ->where('cart_id', $cart_id)
                     ->update(['store_id'=>0,
                     'cancel_by_store'=>$cancel]);
            
             $carte= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->where('store_approval',0)
            ->get();
            $cart_update= DB::connection('mysql_sec')->table('store_orders')
            ->where('order_cart_id', $cart_id)
            ->update(['store_approval'=>1]);
        $data[]=array('result'=>'Order Rejected successfully');
        }    
        return $data;
                       
                    
    }
    
    

   public function storeconfirm(Request $request)
    {
       $cart_id= $request->cart_id;
       $store_id = $request->store_id;
      $currdate = Carbon::now();
       $curr = DB::connection('mysql_sec')->table('currency')
             ->first();
       
     $store= DB::connection('mysql_sec')->table('store')
        	->where('store_id',$store_id)
    	 	->first();
             
      $del_boy = DB::connection('mysql_sec')->table('delivery_boy')
          ->select("boy_name","boy_phone","dboy_id"
        ,DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$store->lat . ")) 
        * cos(radians(lat)) 
        * cos(radians(lng) - radians(" . $store->lng . ")) 
        + sin(radians(" .$store->lat. ")) 
        * sin(radians(lat))) AS distance"))
       ->where('delivery_boy.boy_city',$store->city)    
       ->orderBy('distance')
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
              else{
                  $message = array('status'=>'0', 'message'=>$pr->product_name."(".$pr->quantity." ".$pr->unit.") is not available in your product list");
	              return $message;
              }
             }        
    if($del_boy){   
       $orderconfirm = DB::connection('mysql_sec')->table('orders')
                    ->where('cart_id',$cart_id)
                    ->update(['order_status'=>'Confirmed',
                    'dboy_id'=>$del_boy->dboy_id,
                     'confirmed_at' => $currdate]);
         
 		   
         if($orderconfirm){
                $notification_title = "You Got a New Order for Delivery on ".$orr->delivery_date;
                $notification_text = "you got an order with cart id #".$cart_id." of price ".$curr->currency_sign." " .$orr->total_price. ". It will have to delivered on ".$orr->delivery_date." between ".$orr->time_slot.".";
                
                $date = date('d-m-Y');
                $getUser = DB::connection('mysql_sec')->table('delivery_boy')
                                ->get();
        
                $getDevice = DB::connection('mysql_sec')->table('delivery_boy')
                         ->where('dboy_id', $del_boy->dboy_id)
                        ->select('device_id')
                        ->first();
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
             
             
        	$message = array('status'=>'1', 'message'=>'order is confirmed');
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'something went wrong');
	        return $message;
    	} 
    }
    else{
        	$message = array('status'=>'0', 'message'=>'No Delivery Boy in Your City');
	        return $message;
    }
    }


    public function storeOrdersWithRange(Request $request){
        $validation = Validator::make($request->all(), [
                'to' => 'required',
                'from' => 'required',
                'order_type' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
          
            $to   = $this->dateFormating($request->to);
            $from = $this->dateFormating($request->from,true);
            //print_r($to); die;
            $store = auth('store_api')->user();
            $store_id = $store->store_id;

          // $startTime = new \DateTime($request->date);
          // $orderdate =  $startTime->format('Y-m-d');
          //echo $orderdate;die;
          if($request->order_type ==2){
            $order = $this->PendingOrdersWithRange($store_id,$to,$from);
          }else{
            $order = $this->CompleteOrdersWithRange($store_id,$to,$from);
          }
          return apiResponse(true,200,$order);
        } 
    }

    public function PendingOrdersWithRange($store_id,$to,$from){
      $order = DB::connection('mysql_sec')->table('orders')
          ->join('users', 'orders.user_id', '=','users.user_id')
          ->leftJoin('address','orders.address_id','=','address.address_id')
          ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
          ->select('orders.order_id','orders.dboy_assigned','orders.order_date','orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','delivery_boy.dboy_id','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','orders.order_status','orders.payment_method','orders.timeslot_delivery_date','users.user_phone','address.*',DB::connection('mysql_sec')->raw('(SELECT COUNT(order_items.order_id) FROM order_items WHERE order_items.order_id=orders.order_id) AS orderItems'))
          ->where('orders.store_id',$store_id)
          ->whereBetween('orders.order_date',[$to,$from])
           ->where(function ($query) {
                    $query->where('orders.order_status','=',1)
                      ->orWhere('orders.order_status','=',2)
                      ->orWhere('orders.order_status','=',3)
                      ->orWhere('orders.order_status','=',5)
                      ->orWhere('orders.order_status','=',7);
                })
          ->orderBy('order_date','DESC')
          ->get();

        foreach($order as $ord){
            $time_id =$ord->time_slot;
            $time =  DB::connection('mysql_sec')->table('store_time_slot')
                    ->where(['id'=>$time_id])->first();
            $ord->time_slot = $time->opening_time.' - '.$time->closing_time;
        }

        $dates = DB::connection('mysql_sec')->table('orders')
          ->where('store_id',$store_id)
          ->where(function ($query) {
                $query->where('orders.order_status','=',1)
                  ->orWhere('orders.order_status','=',2)
                  ->orWhere('orders.order_status','=',3)
                  ->orWhere('orders.order_status','=',5)
                  ->orWhere('orders.order_status','=',7);
            })
          ->groupBy('order_date')->orderBy('order_date','DESC')->pluck('order_date')->toArray();
          $newdates =array();
          foreach ($dates as $date) {
            $date =  \Carbon\Carbon::parse($date)->format('Y-m-d');
            $newdates[$date] =$date;
          }
        $newdates = array_keys($newdates);
        $data['dates'] =$newdates;
        $data['orders'] =$order;
        return $data;
    }

    public function CompleteOrdersWithRange($store_id,$to,$from){
        $order = DB::connection('mysql_sec')->table('orders')
          ->join('users', 'orders.user_id', '=','users.user_id')
          ->leftJoin('address','orders.address_id','=','address.address_id')
          ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
          ->select('orders.order_id','orders.order_date','orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','delivery_boy.dboy_id','orders.order_status','orders.payment_method','orders.timeslot_delivery_date','users.user_phone','address.*',DB::connection('mysql_sec')->raw('(SELECT COUNT(order_items.order_id) FROM order_items WHERE order_items.order_id=orders.order_id) AS orderItems'))
          ->where('orders.store_id',$store_id)
          ->whereBetween('orders.order_date',[$to,$from])
          ->where('orders.order_status','=',4)
          ->orderBy('order_date','DESC')
          ->get();
          
        foreach($order as $ord){
            $time_id =$ord->time_slot;
            $time =  DB::connection('mysql_sec')->table('store_time_slot')
                    ->where(['id'=>$time_id])->first();
            $ord->time_slot = $time->opening_time.' - '.$time->closing_time;
        }
        $dates = DB::connection('mysql_sec')->table('orders')
          ->where('store_id',$store_id)
          ->where('orders.order_status','=',4)
          ->groupBy('order_date')->orderBy('order_date','DESC')->pluck('order_date')->toArray();
          $newdates =array();
          foreach ($dates as $date) {
            $date =  \Carbon\Carbon::parse($date)->format('Y-m-d');
            $newdates[$date] =$date;
          }
        $newdates = array_keys($newdates);
        $data['dates'] =$newdates;
        $data['orders'] =$order;
        return $data;
    }


    public function storeOrders(Request $request){
        $validation = Validator::make($request->all(), [
                'date' => 'required',
                'order_type' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
          
          $store = auth('store_api')->user();
          $store_id = $store->store_id;

          $startTime = new \DateTime($request->date);
          $orderdate =  $startTime->format('Y-m-d');
          //echo $orderdate;die;
          if($request->order_type ==2){
            $order = $this->CompleteOrders($store_id,$orderdate);
          }else{
            $order = $this->PendingOrders($store_id,$orderdate);
          }
          return apiResponse(true,200,$order);
        } 
    }


  public function PendingOrders($store_id, $date){
      $order = DB::connection('mysql_sec')->table('orders')
          ->join('users', 'orders.user_id', '=','users.user_id')
          ->leftJoin('address','orders.address_id','=','address.address_id')
          ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
          ->select('orders.order_id','orders.dboy_assigned','orders.order_date','orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','delivery_boy.dboy_id','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','orders.order_status','orders.payment_method','orders.timeslot_delivery_date','users.user_phone','address.*',DB::connection('mysql_sec')->raw('(SELECT COUNT(order_items.order_id) FROM order_items WHERE order_items.order_id=orders.order_id) AS orderItems'))
          ->where('orders.store_id',$store_id)
          ->whereDate('orders.order_date',$date)
           ->where(function ($query) {
                    $query->where('orders.order_status','=',1)
                      ->orWhere('orders.order_status','=',2)
                      ->orWhere('orders.order_status','=',3)
                      ->orWhere('orders.order_status','=',5)
                      ->orWhere('orders.order_status','=',7);
                })
          ->orderBy('order_date','DESC')
          ->get();

    foreach($order as $ord){
        $time_id =$ord->time_slot;
        $time =  DB::connection('mysql_sec')->table('store_time_slot')
                ->where(['id'=>$time_id])->first();
        $ord->time_slot = $time->opening_time.' - '.$time->closing_time;
    }

    $dates = DB::connection('mysql_sec')->table('orders')
      ->where('store_id',$store_id)
      ->where(function ($query) {
            $query->where('orders.order_status','=',1)
              ->orWhere('orders.order_status','=',2)
              ->orWhere('orders.order_status','=',3)
              ->orWhere('orders.order_status','=',5)
              ->orWhere('orders.order_status','=',7);
        })
      ->groupBy('order_date')->orderBy('order_date','DESC')->pluck('order_date')->toArray();
      $newdates =array();
      foreach ($dates as $date) {
        $date =  \Carbon\Carbon::parse($date)->format('Y-m-d');
        $newdates[$date] =$date;
      }
    $newdates = array_keys($newdates);
    $data['dates'] =$newdates;
    $data['orders'] =$order;
    return $data;
  }

  public function CompleteOrders($store_id, $date){
    $order = DB::connection('mysql_sec')->table('orders')
          ->join('users', 'orders.user_id', '=','users.user_id')
          ->leftJoin('address','orders.address_id','=','address.address_id')
          ->leftJoin('delivery_boy', 'orders.dboy_id', '=','delivery_boy.dboy_id')
          ->select('orders.order_id','orders.order_date','orders.cart_id','users.user_name', 'users.user_phone', 'orders.delivery_date', 'orders.total_price','orders.delivery_charge','orders.rem_price','orders.payment_status','delivery_boy.boy_name','delivery_boy.boy_phone','orders.time_slot','delivery_boy.dboy_id','orders.order_status','orders.payment_method','orders.timeslot_delivery_date','users.user_phone','address.*',DB::connection('mysql_sec')->raw('(SELECT COUNT(order_items.order_id) FROM order_items WHERE order_items.order_id=orders.order_id) AS orderItems'))
          ->where('orders.store_id',$store_id)
          ->whereDate('orders.order_date',$date)
          ->where('orders.order_status','=',4)
          ->orderBy('order_date','DESC')
          ->get();
          
    foreach($order as $ord){
        $time_id =$ord->time_slot;
        $time =  DB::connection('mysql_sec')->table('store_time_slot')
                ->where(['id'=>$time_id])->first();
        $ord->time_slot = $time->opening_time.' - '.$time->closing_time;
    }
    $dates = DB::connection('mysql_sec')->table('orders')
      ->where('store_id',$store_id)
      ->where('orders.order_status','=',4)
      ->groupBy('order_date')->orderBy('order_date','DESC')->pluck('order_date')->toArray();
      $newdates =array();
      foreach ($dates as $date) {
        $date =  \Carbon\Carbon::parse($date)->format('Y-m-d');
        $newdates[$date] =$date;
      }
    $newdates = array_keys($newdates);
    $data['dates'] =$newdates;
    $data['orders'] =$order;
    return $data;
  }

    public function ordersDetails(Request $request){
    $validation = Validator::make($request->all(), [
            'order_id' => 'required'
    ]);
    if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
    }else{
      $store = auth('store_api')->user();
      $store_id = $store->store_id;
      $order_id = $request->order_id;
      $order = DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->first();
      
        $time_id =$order->time_slot;
        $time =  DB::connection('mysql_sec')->table('store_time_slot')
                ->where(['id'=>$time_id])->first();
        $order->time_slot = $time->opening_time.' - '.$time->closing_time;

        // if($order->order_status == 5){
        //     $order->order_status = 2;
        // }
        // if( $order->order_status == 2 || $order->order_status== 7 || ($order->dboy_request_at=='' || $order->dboy_request_at ==NULL)){
        //     $order->order_status =3;
        // }

        // if($order->order_status== 3 || ($order->dboy_assigned=='' || $order->dboy_assigned ==NULL)){
        //     $order->order_status =4;
        // }

        // if($order->order_status== 4){
        //     $order->order_status =5;
        // }

      $orderItem =  DB::connection('mysql_sec')->table('order_items')
        ->join('product', 'product.product_id', '=','order_items.product_id')
        ->select('order_items.*','product.product_image')
        ->where('order_items.order_id',$order->order_id)->get();

      $address =  DB::connection('mysql_sec')->table('address')
                    ->where('address_id',$order->address_id)->first();

      $dboy =  DB::connection('mysql_sec')->table('delivery_boy')
                    ->where('dboy_id',$order->dboy_id)->first();

      $user = DB::connection('mysql_sec')->table('users')
              ->select('user_name','user_phone','user_email','user_image')
              ->where('user_id',$order->user_id)->first();

      $order->order_items = $orderItem;
      $order->address = $address;
      $order->dboy = $dboy;
      $order->user = $user;
      return apiResponse(true,200,$order);
    } 
  }

  public function confirmOrder(Request $request){
    $validation = Validator::make($request->all(), [
            'order_id' => 'required'
    ]);
    if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
    }else{
      $order_id = $request->order_id;
      $data['order_status'] =5;

      $order = DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->first();

      DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->update($data);

      userNoctification('Your Order is accepted','Your Order is accepted by store',$order->user_id);
      return apiResponse(true,204,'Order Confirmed Successfully');
    }
  }

  public function rejectOrder(Request $request){
    $validation = Validator::make($request->all(), [
            'order_id' => 'required'
    ]);
    if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
    }else{
      $order_id = $request->order_id;
      $data['order_status'] =0;

      $order = DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->first();

      DB::connection('mysql_sec')->table('orders')->where('order_id',$order_id)->update($data);

      userNoctification('Your Order is rejected','Your Order is rejected',$order->user_id);
      return apiResponse(true,204,'Order Rejected Successfully');
    }
  }

  public function storeProducts(Request $request){
    //  $validation = Validator::make($request->all(), [
    //         'order_id' => 'required'
    // ]);
    // if($validation->fails()) {
    //     return array('status'=>442,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
    // }else{
      $store = auth('store_api')->user();
      $store_id = $store->store_id;
      $products = DB::connection('mysql_sec')->table('store_products')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->where('store_id', $store_id)
                ->select('store_products.*','product.product_name','product.product_image','product_varient.description','categories.title AS cate_title','categories.image AS cate_image','categories.description AS cate_description','product_varient.unit')
                ->orderBy('store_products.stock','asc')
                ->get();
        foreach($products as $p){
            $p->request_quantity =0;
            $p->is_stock_request=0;
            $req = DB::connection('mysql_sec')->table('admin_notification')
                ->where('store_id',$store_id)
                ->where('varient_id',$p->varient_id)
                ->where('is_stock_request',1)
                ->orderBy('admin_notification.not_id','desc')->get();
            if(count($req) >0){
                $p->request_quantity =$req[0]->quantity;    
                $p->is_stock_request =$req[0]->is_stock_request;    
            }
        }
        return apiResponse(true,202,$products);
   // } 
  }

  public function Products(Request $request){
      $store = auth('store_api')->user();
      $store_id = $store->store_id;

      $check=  DB::connection('mysql_sec')->table('store_products')->where('store_id', $store_id)->get();
      $ch3=array();
      if(count($check)>0)  {
        foreach($check as $ch){
            $ch2 = $ch->varient_id;
            $ch3[] = array($ch2);
        }
      }
      $products = DB::connection('mysql_sec')->table('product_varient')
        ->join('product','product_varient.product_id', '=', 'product.product_id')
        ->join('categories','product.cat_id', '=', 'categories.cat_id')
        ->whereNotIn('product_varient.varient_id', $ch3)->get();

      // $products = DB::connection('mysql_sec')->table('product')
      //           ->join('product_varient', 'product_varient.product_id', '=', 'product.product_id')
      //           ->join('categories','product.cat_id', '=', 'categories.cat_id')
      //           ->get();
        return apiResponse(true,202,$products);
  }

  public function addProducts(Request $request){
    $validation = Validator::make($request->all(), [
         'varient_id' => 'required'
    ]);
    if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
    }else{
      $store = auth('store_api')->user();
      $store_id = $store->store_id;
      $varient_id = $request->varient_id;
      $pr= DB::connection('mysql_sec')->table('product_varient')->where('varient_id',$varient_id)->first();
      //echo"<pre>";print_r($pr);die;
      $insert2 = DB::connection('mysql_sec')->table('store_products')
      ->insert(['store_id'=>$store_id,'stock'=>0, 'varient_id'=>$varient_id, 'price'=>$pr->base_price,'mrp'=>$pr->base_mrp,'discount_type'=>$pr->discount_type,'discount_amount'=>$pr->discount_amount,'store_discount_type'=>$pr->discount_type,'total_discount'=>$pr->discount_amount]);
      return apiResponse(true,204,'Product Added Successfully');
    }
  }

  public function removeProducts(Request $request){
    $validation = Validator::make($request->all(), [
       'p_id' => 'required'
    ]);
    if($validation->fails()) {
      return apiResponse(false,406,$validation->getMessageBag());
    }else{
      $store = auth('store_api')->user();
      $store_id = $store->store_id;
      $p_id = $request->p_id;
      DB::connection('mysql_sec')->table('store_products')->where(['p_id'=>$p_id,'store_id'=>$store_id])->delete();
      return apiResponse(true,204,'Product Removed Successfully');
    }
  }

  public function stockRequest(Request $request){
    $validation = Validator::make($request->all(), [
         'varient_id' => 'required',
         'quantity' => 'required'
    ]);
    if($validation->fails()) {
        return apiResponse(false,406,$validation->getMessageBag());
    }else{
      $store = auth('store_api')->user();
      $store_id = $store->store_id;
      $quantity = $request->quantity;
      $varient_id = $request->varient_id;
      $data['not_title'] = 'WooHoo ! You Got a New Order';
      $data['not_message'] = 'WooHoo ! You Got a New Order';
      $data['store_id'] = $store_id;
      $data['varient_id'] = $varient_id;
      $data['quantity'] = $quantity;

      $data['is_stock_request']=1;
      DB::connection('mysql_sec')->table('admin_notification')->insert($data);

      storeNoctification($data['not_title'],$data['not_message'],0);

      addActivityLog('request for stock',$store_id,3);

      return apiResponse(true,204,'Successfully Sent');

    }
  }
  public function stockRequestList(Request $request){
    $store = auth('store_api')->user();
    $store_id = $store->store_id;
    if($store->is_default !=1){
      return apiResponse(false,407,'You Not Allowed This Request');
    }
    $requestq = DB::connection('mysql_sec')->table('admin_notification')
                ->join('store', 'store.store_id', '=', 'admin_notification.store_id')
                ->join('store_products', 'store_products.store_id', '=', 'admin_notification.store_id')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                ->select('admin_notification.*','product_varient.quantity AS product_quantity','store.store_name','store.email','store.phone_number','store.owner_id','product.product_name','product_varient.product_id','product_varient.discount_type','product_varient.discount_amount','product_varient.unit','product_varient.base_mrp','product_varient.base_price','product_varient.increment_value','product.product_image')
                ->where('admin_notification.is_stock_request',1)
                ->groupBy('admin_notification.not_id')
                ->get();
   // dd($requestq);
        return apiResponse(true,202,$requestq);
  }

  public function AllocateStock(Request $request){

      $validation = Validator::make($request->all(), [
            'allocated_quantity' => 'required',
            'not_id' => 'required',
      ]);
      if($validation->fails()) {
          return apiResponse(false,406,$validation->getMessageBag());
      }
        $not_id = $request->not_id;
        $allocated_quantity = $request->allocated_quantity;
        
        $noti = DB::connection('mysql_sec')->table('admin_notification')->where('not_id', $not_id)->first();
        $varient_id = $noti->varient_id;
        $store_id   = $noti->store_id;
        
        

        $data['allocated_quantity'] = $allocated_quantity;
        $data['is_stock_request']   =0;

        DB::connection('mysql_sec')->table('admin_notification')->where('not_id', $not_id)->update($data);

        $store =DB::connection('mysql_sec')->table('store_products')
        ->where(['varient_id'=>$varient_id,'store_id'=>$store_id])->first();

        $data2['stock']=$store->stock +$allocated_quantity;
        DB::connection('mysql_sec')->table('store_products')
        ->where(['varient_id'=>$varient_id,'store_id'=>$store_id])->update($data2);

        $adminstock = DB::connection('mysql_sec')->table('product_varient')
                ->where(['varient_id'=>$varient_id])->first();

        $data3['quantity'] =$adminstock->quantity-$allocated_quantity;
        DB::connection('mysql_sec')->table('product_varient')
                ->where(['varient_id'=>$varient_id])->update($data3);
        $data4['stock'] = $data3['quantity'];
        DB::connection('mysql_sec')->table('store_products')
                ->where(['varient_id'=>$varient_id,'store_id'=>0])->update($data4);

        storeNoctification('Stock Allocated','Admin Allocate '.$allocated_quantity.'quantity of Product',$store_id);
        return apiResponse(true,204,'Stock Allocated to store successfully');
    }

    public function rejectStockRequest(Request $request){

      $validation = Validator::make($request->all(), [
            'not_id' => 'required'
      ]);
      if($validation->fails()) {
          return apiResponse(false,406,$validation->getMessageBag());
      }

      $rq = DB::connection('mysql_sec')->table('admin_notification')->where('not_id',$request->not_id)->first();

      storeNoctification('Your Request is rejected for stcok','Your Request is rejected for stcok',$rq->store_id);
      return apiResponse(true,204,'Your Request is rejected for stcok');
    }



    public function dateFormating($date,$enday=false){
        // $startTime = new \DateTime($date);
        // $newdate = $startTime->format('Y-m-d');
        // return $newdate;
        if($enday){
            return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->endOfDay()->toDateTimeString();
        }
        return  \Carbon\Carbon::createFromFormat('Y-m-d', $date)->toDateTimeString();    
    }

}