<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class StoreearningsController extends Controller
{
    public function finance(Request $request)
    {
        $title = "Product section";
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
         $total_earnings=DB::connection('mysql_sec')->table('store')
                           ->join('orders','store.store_id','=','orders.store_id')
                           ->leftJoin('store_earning','store.store_id','=','store_earning.store_id')
                           ->select('store_earning.paid',DB::connection('mysql_sec')->raw('SUM(orders.total_price)-SUM(orders.total_price)*(store.admin_share)/100 as sumprice'))
                           ->where('orders.order_status','Completed')
                           ->where('store.store_id',$store->store_id)
                           ->first();
                        
    	return view('protocol.admin.store.finance', compact('title',"admin", "logo","total_earnings"));
    }
    
    
       
}
