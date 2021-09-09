<?php

namespace App\Http\Controllers\Protocol\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class HomeController extends Controller
{
    public function storeHome(Request $request)
    {
        $title = "Store Dashboard";
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();	
          
          $st_earnings = DB::connection('mysql_sec')->table('store_earning')
                      ->where('store_id',$store->store_id)
                      ->first();
                
          $total_earnings=DB::connection('mysql_sec')->table('store')
                           ->join('orders','store.store_id','=','orders.store_id')
                           ->leftJoin('store_earning','store.store_id','=','store_earning.store_id')
                           ->select('store_earning.paid',DB::connection('mysql_sec')->raw('SUM(orders.total_price)-SUM(orders.total_price)*(store.admin_share)/100 as sumprice'))
                           ->groupBy('store_earning.paid','store.admin_share')
                           ->where('orders.order_status','Completed')
                           ->where('store.store_id',$store->store_id)
                           ->first();
        if($total_earnings){                  
            $sum = $total_earnings->sumprice;
        }
            else{
               $sum = 0; 
            }
             
         if($st_earnings){                  
            $paid = $total_earnings->paid;
        }
            else{
               $paid = 0; 
            }     
                          
         $completed_orders =  DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','Completed')
                           ->where('store_id',$store->store_id)
                           ->count();
                           
        
        $pending =   DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','Pending')
                           ->where('store_id',$store->store_id)
                           ->count();
                           
                           
        $cancelled = DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','Cancelled')
                           ->where('store_id',$store->store_id)
                           ->count();   
                           
        
    	return view('protocol.store.home', compact('title',"store", "logo","total_earnings","pending","cancelled","completed_orders","sum","paid"));
    }
}
