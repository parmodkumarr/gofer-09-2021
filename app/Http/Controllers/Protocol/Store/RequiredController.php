<?php
namespace App\Http\Controllers\Protocol\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
class RequiredController extends Controller
{

    
 public function reqfortoday(Request $request)
     {
         $date = date('Y-m-d');
       $title = "Required Product List";
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	 $store_id = $store->store_id;		   
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
    	 		   
        $ord =DB::connection('mysql_sec')->table('store_orders')
             ->join ('orders','store_orders.order_cart_id', '=', 'orders.cart_id')
             ->join('product_varient', 'store_orders.varient_id', '=','product_varient.varient_id')
             ->join('product', 'product_varient.product_id', '=','product.product_id')
             ->select('product.product_name', 'product.product_id','product.product_id')
             ->groupBy('product.product_name', 'product.product_id','product.product_id')
             ->where('orders.delivery_date',$date)
             ->where('orders.payment_method','!=', NULL)
             ->where('orders.store_id', $store_id)
              ->where('orders.order_status','!=', 'Cancelled')
               ->where('orders.order_status','!=', 'Completed')
             ->get();
             
             
        $det =  DB::connection('mysql_sec')->table('store_orders')
             ->join ('orders','store_orders.order_cart_id', '=', 'orders.cart_id')
             ->join('product_varient', 'store_orders.varient_id', '=','product_varient.varient_id')
             ->join('product', 'product_varient.product_id', '=','product.product_id')
             ->select('store_orders.quantity', 'store_orders.unit','product.product_id', DB::connection('mysql_sec')->raw('count(store_orders.unit) as count'), DB::connection('mysql_sec')->raw('sum(store_orders.qty) as sumqty'))
             ->groupBy('store_orders.quantity', 'store_orders.unit','product.product_id')
             ->where('orders.delivery_date',$date)
             
             ->where('orders.payment_method','!=', NULL)
             ->where('orders.store_id', $store_id)
              ->where('orders.order_status','!=', 'Cancelled')
              ->where('orders.order_status','!=', 'Completed')
             ->get();    
             
         return view('protocol.store.stocktoday',compact("email","store",'title','logo','ord','det'));
    }      
    
    
    
     public function reqfornextday(Request $request)
     {
         $date = date('Y-m-d');
         $day = 1;
         $next_date = date('Y-m-d', strtotime($date.' + '.$day.' days'));
         $title = "Required Product List";
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	 $store_id = $store->store_id;		   
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
    	 		   
        $ord =DB::connection('mysql_sec')->table('store_orders')
             ->join ('orders','store_orders.order_cart_id', '=', 'orders.cart_id')
             ->join('product_varient', 'store_orders.varient_id', '=','product_varient.varient_id')
             ->join('product', 'product_varient.product_id', '=','product.product_id')
             ->select('product.product_name', 'product.product_id','product.product_id')
             ->groupBy('product.product_name', 'product.product_id','product.product_id')
             ->where('orders.delivery_date',$next_date)
             ->where('orders.payment_method','!=', NULL)
             ->where('orders.store_id', $store_id)
              ->where('orders.order_status','!=', 'Cancelled')
               ->where('orders.order_status','!=', 'Completed')
             ->get();
             
             
        $det =  DB::connection('mysql_sec')->table('store_orders')
             ->join ('orders','store_orders.order_cart_id', '=', 'orders.cart_id')
             ->join('product_varient', 'store_orders.varient_id', '=','product_varient.varient_id')
             ->join('product', 'product_varient.product_id', '=','product.product_id')
             ->select('store_orders.quantity', 'store_orders.unit','product.product_id', DB::connection('mysql_sec')->raw('count(store_orders.unit) as count'), DB::connection('mysql_sec')->raw('sum(store_orders.qty) as sumqty'))
             ->groupBy('store_orders.quantity', 'store_orders.unit','product.product_id')
             ->where('orders.delivery_date',$next_date)
             ->where('orders.payment_method','!=', NULL)
             ->where('orders.store_id', $store_id)
              ->where('orders.order_status','!=', 'Cancelled')
               ->where('orders.order_status','!=', 'Completed')
             ->get();    
             
         return view('protocol.store.stocknextday',compact("email","store",'title','logo','ord','det'));
    }      
 
 
 
 



}