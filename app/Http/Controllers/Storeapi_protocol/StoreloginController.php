<?php

namespace App\Http\Controllers\Storeapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use JWTAuth;
use JWTAuthException;
use Carbon\Carbon;

class StoreloginController extends Controller{

    public function store_owner_login(Request $request){
        
        $email = $request->email;
        $password = $request->password;
        $device_id = $request->device_id;
        $checkstore1 = DB::connection('mysql_sec')->table('store_owner')->where('email',$email)->first();
        $token = JWTAuth::fromUser($checkstore1);
        
        
        if($checkstore1){                   
            
            $checkstore = DB::connection('mysql_sec')->table('store_owner')->where('email', $email)->where('password', $password)->first();

            if($checkstore){

               $userStores = DB::connection('mysql_sec')->table('store')->where('owner_id',$checkstore->id)->get();
               $checkstore->total_stores = $userStores;
               $message = array('status'=>'1', 'message'=>'login successfully', 'data'=>[$checkstore]);
               return $message;
            
            }else{

                $message = array('status'=>'0', 'message'=>'Wrong Password', 'data'=>[]);
                return $message;
            }
        
        }else{

            $message = array('status'=>'0', 'message'=>'Store Owner Not Registered', 'data'=>[]);
            return $message;
        }



    }
    

    public function store_login(Request $request){

    	$email = $request->email;
    	$password = $request->password;
    	$device_id = $request->device_id;
    	$checkstore1 = DB::connection('mysql_sec')->table('store')
    					->where('email', $email)
    					->first();
    if($checkstore1){					
    	$checkstore = DB::connection('mysql_sec')->table('store')
    					->where('email', $email)
    					->where('password', $password)
    					->first();

    	if($checkstore){
    	    if($checkstore->admin_approval==1){  
    		   $updateDeviceId = DB::connection('mysql_sec')->table('store')
    		                       ->where('email', $email)
    		                        ->update(['device_id'=>$device_id]);
    		                       
    		                        
    			$message = array('status'=>'1', 'message'=>'login successfully', 'data'=>[$checkstore]);
	        	return $message;
    	   }	   
    	   else{
    		$message = array('status'=>'0', 'message'=>'Your store is under approval. Please wait for admin approval.', 'data'=>[]);
	        return $message;
    	}
    	}
    	else{
    		$message = array('status'=>'0', 'message'=>'Wrong Password', 'data'=>[]);
	        return $message;
    	}
    }
    else{
        	$message = array('status'=>'0', 'message'=>'Store Not Registered', 'data'=>[]);
	        return $message;
    }
    }
    
    
    
    
    public function storeprofile(Request $request)
    {   
        $store_id = $request->store_id;
         $store=  DB::connection('mysql_sec')->table('store')
                ->leftJoin('orders','store.store_id','=','orders.store_id')
               ->leftJoin('store_earning','store.store_id','=','store_earning.store_id')
               ->select('store.store_name','store.phone_number','store.email','store.address','store_earning.paid',DB::connection('mysql_sec')->raw('SUM(orders.total_price)-SUM(orders.total_price)*(store.admin_share)/100 as store_earning'))
               ->groupBy('store.store_name','store.phone_number','store.email','store.address','store_earning.paid','store.admin_share')
                ->where('store.store_id', $store_id )
                ->first();
                        
    if($store){
        	$message = array('status'=>'1', 'message'=>'Store Profile', 'data'=>$store);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Store not found', 'data'=>[]);
	        return $message;
    	}
        
    }
}