<?php

namespace App\Http\Controllers\Storeapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Validator;
class AmountController extends Controller
{
    public function earn(Request $request)
    {
        $store_id=$request->store_id;
        $total_earnings=DB::connection('mysql_sec')->table('store')
           ->join('orders','store.store_id','=','orders.store_id')
           ->leftJoin('store_earning','store.store_id','=','store_earning.store_id')
           ->select('store_earning.paid',DB::connection('mysql_sec')->raw('SUM(orders.total_price)-SUM(orders.total_price)*(store.admin_share)/100 as sumprice'))
           ->groupBy('store_earning.paid','store.admin_share')
           ->where('orders.order_status','Completed')
           ->where('store.store_id',$store_id)
           ->first();
       	                     
        if($total_earnings){
        	$message = array('status'=>'1', 'message'=>'Store Earnings and paid amount', 'data'=>$total_earnings);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'no store found', 'data'=>[]);
	        return $message;
    	}
    }

    public function CashListByDboy(Request $request)
    {
        $store = auth('store_api')->user();
        $store_id =$store->store_id;
        
        $requestq = DB::connection('mysql_sec')->table('orders')
            ->join('delivery_boy', 'delivery_boy.dboy_id', '=', 'orders.dboy_id')
            ->select('orders.dboy_id','orders.user_id','delivery_boy.boy_name','delivery_boy.boy_phone','delivery_boy.boy_city',DB::raw("(sum(total_price)) as SumofPrice"))
            ->where('orders.store_id','=',$store_id)
            ->where('orders.payment_method','=',1)
            ->where('orders.order_status','=',4)
            ->whereNotNull('orders.dboy_assigned')
            ->where('orders.dboy_id','!=',0)
            ->groupBy('orders.dboy_id')
            ->get();
        return apiResponse(true,202,$requestq);
    }

    public function DboyPayOrder(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'dboy_id' => 'required',
            'date' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $store = auth('store_api')->user();
        $store_id =$store->store_id;
        $dboy_id =$request->dboy_id;
        $date =$request->date;

        $order = DB::connection('mysql_sec')->table('orders')
            ->join('delivery_boy', 'delivery_boy.dboy_id', '=', 'orders.dboy_id')
            ->join('users', 'users.user_id', '=', 'orders.user_id')
            ->select('orders.*','delivery_boy.boy_name','delivery_boy.boy_phone','delivery_boy.boy_city','users.user_name','users.user_email','users.user_phone')
            ->where('orders.store_id','=',$store_id)
            ->where('orders.payment_method','=',1)
            ->where('orders.order_status','=',4)
            ->whereNotNull('orders.dboy_assigned')
            ->where('orders.dboy_id','=',$dboy_id);
         
        $cdate =date('Y-m-d');
        $sdate =date($date);
        if($cdate != $sdate){
            $order = $order->whereDate('orders.order_date',$sdate);   
        }
        $order = $order->get();
        $totalpay =0;
        foreach($order as $ord){
            $totalpay = $totalpay+$ord->total_price;
        }
        $dates = DB::connection('mysql_sec')->table('orders')
            ->where('orders.store_id','=',$store_id)
            ->where('orders.payment_method','=',1)
            ->where('orders.order_status','=',4)
            ->whereNotNull('orders.dboy_assigned')
            ->where('orders.dboy_id','=',$dboy_id)
            ->groupBy('delivery_date')->orderBy('delivery_date','DESC')->pluck('delivery_date')->toArray();
        $newdates =array();
        foreach ($dates as $date) {
            $date =  \Carbon\Carbon::parse($date)->format('Y-m-d');
            $newdates[$date] =$date;
        }
        $newdates = array_keys($newdates);

        $data['dates'] =$newdates;
        $data['orders'] =$order;
        $data['totalpay'] =$totalpay;
        return apiResponse(true,200,$data);

    }

    public function acceptPaymentFromDboy(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $store = auth('store_api')->user();
        $store_id =$store->store_id;
        $order_id =$request->order_id;

        $update = DB::connection('mysql_sec')->table('orders')
                    ->where('store_id','=',$store_id)
                    ->where('order_id','=',$order_id)
                    ->update(['pay_by_dboy'=>'2']);

        return apiResponse(true,204,'Payment Successfully Accepted');
    }
}