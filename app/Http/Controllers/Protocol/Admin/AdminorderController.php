<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use App\Traits\SendMail;
use App\Traits\SendSms;

class AdminorderController extends Controller
{
    use SendMail;
    use SendSms;
    
    public function AllOrdersList(Request $request)
    {
        //echo"<pre>";print_r($request->all());die;
        $ord = DB::connection('mysql_sec')->table('orders')
              ->join('store','orders.store_id', '=', 'store.store_id')
              ->join('users', 'orders.user_id', '=','users.user_id')
              ->leftjoin('delivery_boy','orders.dboy_id', '=', 'delivery_boy.dboy_id')
              ->leftjoin('address','orders.address_id', '=', 'address.address_id')
              ->select('orders.*','users.user_name','users.user_phone','users.user_email','store.store_name','store.owner_id','store.employee_name','store.phone_number AS store_phone','store.city as store_city','store.address as store_address','store.email as store_email','store.lat as store_lat','store.lng as store_lng','store.status as store_status','address.receiver_name','address.receiver_phone','address.city as receiver_city','address.state as receiver_state','address.pincode as receiver_pincode','address.lat as receiver_lat','address.lng as receiver_lng','address.full_address as receiver_address','address.address_type as receiver_address_type','address.other_address as receiver_other_address','delivery_boy.boy_name','delivery_boy.boy_phone','delivery_boy.boy_city','delivery_boy.boy_loc','delivery_boy.lat as dboy_lat','delivery_boy.lng as dboy_lng','delivery_boy.status as dboy_status');
        if(isset($request->order_status)){
            if($request->order_status ==0){
                $ord = $ord->where('orders.order_status','=',$request->order_status);
            }
            if($request->order_status ==1){
               $ord = $ord->where(function($query){
                    $query->where('orders.order_status','!=',4)
                    ->where('orders.order_status','!=',6)
                    ->where('orders.order_status','!=',0);
                });
            }
            if($request->order_status ==2){
                $ord = $ord->where('orders.order_status','=',4);
            }
            if($request->order_status ==4){
                $ord = $ord->where('orders.order_status','=',6);
            }
        }

        if(isset($request->store) && !empty($request->store)){
            $ord = $ord->whereIn('orders.store_id',$request->store);
        }

        if(isset($request->date)){
            $date = explode(" - ",$request->date);
            $from = date($date[0]);
            $to = date($date[1]);
            $ord = $ord->whereBetween('orders.order_date', [$from, $to]);
        }
        if(isset($request->sreach)){
            $search = $request->sreach;
            $ord = $ord->where(function($query) use ($search){
                    $query->where('users.user_name','LIKE','%'.$search.'%')
                    ->orWhere('users.user_phone','LIKE','%'.$search.'%')
                    ->orWhere('users.user_email','LIKE','%'.$search.'%')
                    ->orWhere('address.receiver_name','LIKE','%'.$search.'%')
                    ->orWhere('address.receiver_phone','LIKE','%'.$search.'%')
                    ->orWhere('address.city','LIKE','%'.$search.'%')
                    ->orWhere('address.state','LIKE','%'.$search.'%')
                    ->orWhere('address.pincode','LIKE','%'.$search.'%')
                    ->orWhere('address.other_address','LIKE','%'.$search.'%')
                    ->orWhere('address.full_address','LIKE','%'.$search.'%')

                    ->orWhere('store.store_name','LIKE','%'.$search.'%')
                    ->orWhere('store.phone_number','LIKE','%'.$search.'%')
                    ->orWhere('store.email','LIKE','%'.$search.'%')
                    ->orWhere('store.address','LIKE','%'.$search.'%')
                    ->orWhere('store.city','LIKE','%'.$search.'%')
                    ->orWhere('store.employee_name','LIKE','%'.$search.'%')

                    ->orWhere('delivery_boy.boy_name','LIKE','%'.$search.'%')
                    ->orWhere('delivery_boy.boy_phone','LIKE','%'.$search.'%')
                    ->orWhere('delivery_boy.boy_city','LIKE','%'.$search.'%')
                    ->orWhere('delivery_boy.boy_loc','LIKE','%'.$search.'%');
                });
        }

        $stores = DB::connection('mysql_sec')->table('store')->get();

        $ord = $ord->orderBy('orders.order_id','DESC')->paginate(10);
        //echo"<pre>";print_r($ord);die;
        foreach($ord as $order){
           $details = DB::connection('mysql_sec')->table('orders')
                ->join('store_products','orders.store_id', '=', 'store_products.store_id')
                ->join('order_items', function($join){
                       $join->on('order_items.order_id', '=', 'orders.order_id')
                       ->on('order_items.varient_id', '=', 'store_products.varient_id');
                })
                ->join('product_varient','product_varient.varient_id', '=', 'store_products.varient_id')
                ->join('product','product.product_id', '=', 'product_varient.product_id')
                ->select('product.product_name','product.product_image','order_items.quantity','order_items.total_discount','order_items.unit','order_items.unit','order_items.price','order_items.final_price','order_items.id','order_items.order_id','store_products.stock')
                ->where('order_items.order_id',$order->order_id)
               ->get();
            $order->details = $details;
        }

        if($request->ajax()){
           return view('protocol.admin.store.pagination_data',compact('ord','stores'))->render();
        }

        $title = "Orders List";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')
                   ->where('admin_email',$admin_email)
                   ->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
            ->where('set_id', '1')
            ->first();
        
        $nearbystores = DB::connection('mysql_sec')->table('store')->get();        
                
        return view('protocol.admin.store.allorders', compact('title','logo','ord','details','admin','nearbystores','stores'));  
    }
     public function admin_com_orders(Request $request)
    {
         $title = "Completed Order section";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        $ord =DB::connection('mysql_sec')->table('orders')
              ->join('store','orders.store_id', '=', 'store.store_id')
              ->join('users', 'orders.user_id', '=','users.user_id')
              ->leftjoin('delivery_boy','orders.dboy_id', '=', 'delivery_boy.dboy_id')
             ->orderBy('orders.order_id','DESC')
             ->where('order_status','=',4)
             ->get();

           $details = DB::connection('mysql_sec')->table('orders')
                        ->join('store_products','orders.store_id', '=', 'store_products.store_id')
                        ->join('order_items', function($join){
                               $join->on('order_items.order_id', '=', 'orders.order_id')
                               ->on('order_items.varient_id', '=', 'store_products.varient_id');
                        })
                        ->join('product_varient','product_varient.varient_id', '=', 'store_products.varient_id')
                        ->join('product','product.product_id', '=', 'product_varient.product_id')
                        ->select('product.product_name','product.product_image','order_items.quantity','order_items.unit','order_items.unit','order_items.final_price as price','order_items.id','order_items.order_id','store_products.stock')
    	               ->get();         
           // echo"<pre>";print_r($details);die;    
       return view('protocol.admin.all_orders.com_orders', compact('title','logo','ord','details','admin'));         
    }
    
    
    
      public function admin_can_orders(Request $request)
    {
         $title = "Cancelled Order section";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        $ord =DB::connection('mysql_sec')->table('orders')
              ->join('store','orders.store_id', '=', 'store.store_id')
              ->join('users', 'orders.user_id', '=','users.user_id')
              ->leftjoin('delivery_boy','orders.dboy_id', '=', 'delivery_boy.dboy_id')
             ->orderBy('orders.order_id','DESC')
             ->where('order_status','=',0)
             ->get();

           $details = DB::connection('mysql_sec')->table('orders')
                ->join('store_products','orders.store_id', '=', 'store_products.store_id')
                ->join('order_items', function($join){
                       $join->on('order_items.order_id', '=', 'orders.order_id')
                       ->on('order_items.varient_id', '=', 'store_products.varient_id');
                })
                ->join('product_varient','product_varient.varient_id', '=', 'store_products.varient_id')
                ->join('product','product.product_id', '=', 'product_varient.product_id')
                ->select('product.product_name','product.product_image','order_items.quantity','order_items.unit','order_items.unit','order_items.final_price as price','order_items.id','order_items.order_id','store_products.stock')
               ->get();      
                
       return view('protocol.admin.all_orders.cancelled', compact('title','logo','ord','details','admin'));         
    }
    
    
      public function admin_pen_orders(Request $request)
    {
         $title = "Pending Order section";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        $ord =DB::connection('mysql_sec')->table('orders')
              ->join('store','orders.store_id', '=', 'store.store_id')
              ->join('users', 'orders.user_id', '=','users.user_id')
              ->leftjoin('delivery_boy','orders.dboy_id', '=', 'delivery_boy.dboy_id')
             ->orderBy('orders.order_id','DESC')
             ->where('order_status','=',1)
             ->orWhere('order_status','=',2)
             ->orWhere('order_status','=',3)
             ->get();

           $details = DB::connection('mysql_sec')->table('orders')
                ->join('store_products','orders.store_id', '=', 'store_products.store_id')
                ->join('order_items', function($join){
                       $join->on('order_items.order_id', '=', 'orders.order_id')
                       ->on('order_items.varient_id', '=', 'store_products.varient_id');
                })
                ->join('product_varient','product_varient.varient_id', '=', 'store_products.varient_id')
                ->join('product','product.product_id', '=', 'product_varient.product_id')
                ->select('product.product_name','product.product_image','order_items.quantity','order_items.unit','order_items.unit','order_items.final_price as price','order_items.id','order_items.order_id','store_products.stock')
               ->get();         
                
       return view('protocol.admin.all_orders.pending', compact('title','logo','ord','details','admin'));         
    }
    
    
    public function admin_store_orders(Request $request)
    {
         $title = "Store Order section";
         $id = $request->id;
         $store = DB::connection('mysql_sec')->table('store')
                ->where('store_id',$id)
                ->first();
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        $ord =DB::connection('mysql_sec')->table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->where('orders.store_id',$store->store_id)
             ->orderBy('orders.delivery_date','ASC')
             ->where('order_status','!=', 'completed')
             ->get();
             
         $details  =   DB::connection('mysql_sec')->table('orders')
    	                ->join('store_orders', 'orders.cart_id', '=', 'store_orders.order_cart_id') 
    	               ->where('orders.store_id',$id)
    	               ->where('store_orders.store_approval',1)
    	               ->get();         
                
       return view('protocol.admin.store.orders', compact('title','logo','ord','store','details','admin'));         
    }
    
    
    
     public function admin_dboy_orders(Request $request)
    {
         $title = "Delivery Boy Order section";
         $id = $request->id;
         $dboy = DB::connection('mysql_sec')->table('delivery_boy')
                ->where('dboy_id',$id)
                ->first();
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
    
          $date = date('Y-m-d');
     $nearbydboy = DB::connection('mysql_sec')->table('delivery_boy')
                ->leftJoin('orders', 'delivery_boy.dboy_id', '=', 'orders.dboy_id') 
                ->select("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city",DB::connection('mysql_sec')->raw("Count(orders.order_id)as count"),DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$dboy->lat . ")) 
                * cos(radians(delivery_boy.lat)) 
                * cos(radians(delivery_boy.lng) - radians(" . $dboy->lng . ")) 
                + sin(radians(" .$dboy->lat. ")) 
                * sin(radians(delivery_boy.lat))) AS distance"))
               ->groupBy("delivery_boy.boy_name","delivery_boy.dboy_id","delivery_boy.lat","delivery_boy.lng","delivery_boy.boy_city")
               ->where('delivery_boy.boy_city', $dboy->boy_city)
               ->where('delivery_boy.dboy_id','!=',$dboy->dboy_id)
               ->orderBy('count')
               ->orderBy('distance')
               ->get();  
    
                
        $ord =DB::connection('mysql_sec')->table('orders')
             ->join('users', 'orders.user_id', '=','users.user_id')
             ->where('orders.dboy_id',$dboy->dboy_id)
             ->orderBy('orders.delivery_date','ASC')
             ->where('order_status','!=', 'completed')
             ->paginate(10);
             
         $details  =   DB::connection('mysql_sec')->table('orders')
    	               ->join('store_orders', 'orders.cart_id', '=', 'store_orders.order_cart_id') 
    	               ->where('orders.dboy_id',$id)
    	               ->where('store_orders.store_approval',1)
    	               ->get();         
                
       return view('protocol.admin.d_boy.orders', compact('title','logo','ord','dboy','details','admin','nearbydboy'));         
    }
    
    
    
    public function store_cancelled(Request $request)
    {
         $title = "Store Cancelled Orders";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        $ord =DB::connection('mysql_sec')->table('orders')
              ->join('store','orders.store_id', '=', 'store.store_id')
              ->join('users', 'orders.user_id', '=','users.user_id')
              ->leftjoin('delivery_boy','orders.dboy_id', '=', 'delivery_boy.dboy_id')
              ->leftjoin('address','orders.address_id', '=', 'address.address_id')
             ->orderBy('orders.order_id','DESC')
             ->where('order_status','=',7)
             ->get();
        foreach($ord as $order){
           $details = DB::connection('mysql_sec')->table('orders')
                ->join('store_products','orders.store_id', '=', 'store_products.store_id')
                ->join('order_items', function($join){
                       $join->on('order_items.order_id', '=', 'orders.order_id')
                       ->on('order_items.varient_id', '=', 'store_products.varient_id');
                })
                ->join('product_varient','product_varient.varient_id', '=', 'store_products.varient_id')
                ->join('product','product.product_id', '=', 'product_varient.product_id')
                ->select('product.product_name','product.product_image','order_items.quantity','order_items.unit','order_items.unit','order_items.final_price as price','order_items.id','order_items.order_id','store_products.stock')
                ->where('order_items.order_id',$order->order_id)
               ->get();
               //,'orders.tax','orders.delivery_charge','orders.delivery_charge_km','orders.delivery_distance'
            $order->details = $details;
        }
             
        //echo "<pre>";print_r($ord); die;  
        $nearbystores = DB::connection('mysql_sec')->table('store')
                          ->get();        
                
       return view('protocol.admin.store.cancel_orders', compact('title','logo','ord','details','admin','nearbystores'));  
    }
    
    
    public function assignstore(Request $request)
    {
         $title = "Store Cancelled Orders";
         $cart_id=$request->id;
         $store = $request->store;
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
      
          $ord =DB::connection('mysql_sec')->table('orders')
             ->where('cart_id', $cart_id)
             ->update(['store_id'=>$store, 'cancel_by_store'=>0]);
             
      
      return redirect()->back()->withSuccess('Assigned to store successfully');
    }
    
    
    
    
       public function assigndboy(Request $request)
    {
         $cart_id=$request->id;
         $d_boy = $request->d_boy;
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
      
          $ord =DB::connection('mysql_sec')->table('orders')
             ->where('cart_id', $cart_id)
             ->update(['dboy_id'=>$d_boy]);
             
      
      return redirect()->back()->withSuccess('Assigned to Another Delivery Boy Successfully');
    }
    
    
        public function rejectorder(Request $request)
    {
         $cart_id=$request->id;
         $ord= DB::connection('mysql_sec')->table('orders')
    	 		->where('cart_id',$cart_id)
    	 		->first();
    	 $total_price = $ord->rem_price;		
    	 $user = DB::connection('mysql_sec')->table('users')
    	 		->where('user_id',$ord->user_id)
    	 		->first();	
    	 $user_id = $ord->user_id;		
    	 $wall = $user->wallet;		
    	 $bywallet = $ord->paid_by_wallet;	
    	 if($ord->payment_method != 'COD' || $ord->payment_method != 'cod'|| $ord->payment_method != 'Cod'){
    	$newwallet = $wall + $total_price + $bywallet;
    	$update = DB::connection('mysql_sec')->table('users')
    	 		->where('user_id',$ord->user_id)
    	 		->update(['wallet'=>$newwallet]);
    	 }	
    	 else{
    	     	$newwallet = $wall + $bywallet;
    	$update = DB::connection('mysql_sec')->table('users')
    	 		->where('user_id',$ord->user_id)
    	 		->update(['wallet'=>$newwallet]);
    	 }
    	 
         $cause = $request->cause;
         
         $checknotificationby = DB::connection('mysql_sec')->table('notificationby')
                              ->where('user_id',$user->user_id)
                              ->first();
         if($checknotificationby->sms == 1){
         $sendmsg = $this->sendrejectmsg($cause,$user,$cart_id);
         }
         if($checknotificationby->email == 1){
         $sendmail = $this->sendrejectmail($cause,$user,$cart_id);
         }
         if($checknotificationby->app == 1){
         //////send notification to user//////////
             $notification_title = "Sorry! we are cancelling your order";
                        $notification_text = 'Hello '.$user->user_name.', We are cancelling your order ('.$cart_id.') due to following reason:  '.$cause;
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
         
          $ord =DB::connection('mysql_sec')->table('orders')
             ->where('cart_id', $cart_id)
             ->update(['cancelling_reason'=>"Cancelled by Admin due to the following reason: ".$cause,
             'order_status'=>"cancelled"]);
         return redirect()->back()->withSuccess('Order Rejected Successfully');
    }
    
}