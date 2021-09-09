<?php

namespace App\Http\Controllers\Driverapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;
class DriverstatusController extends Controller
{
   public function status(Request $request)
    { 
        $dboy_id = $request->dboy_id; 
        $status = $request->status;
        
        $update= DB::connection('mysql_sec')->table('delivery_boy') 
               ->where('dboy_id', $dboy_id)
               ->update(['status'=>$status]);
               
        if($update){
            $message = array('status'=>'1', 'message'=>'Status Updated');
        	return $message;
        }  
        else{
            $message = array('status'=>'0', 'message'=>'Nothing happened');
        	return $message;
        }
               
    }

    public function DboyPayOrder(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'date' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $user = auth('driver_api')->user();
        $dboy_id = $user->dboy_id;
        $date =$request->date;

        $order = DB::connection('mysql_sec')->table('orders')
            ->join('delivery_boy', 'delivery_boy.dboy_id', '=', 'orders.dboy_id')
            ->join('users', 'users.user_id', '=', 'orders.user_id')
            ->join('store', 'store.store_id', '=', 'orders.store_id')
            ->select('orders.*','delivery_boy.boy_name','delivery_boy.boy_phone','delivery_boy.boy_city','users.user_name','users.user_email','users.user_phone','store.store_name')
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
            $time_id =$ord->time_slot;
            $time =  DB::connection('mysql_sec')->table('store_time_slot')
                ->where(['id'=>$time_id])->first();
            $ord->time_slot = $time->opening_time.' - '.$time->closing_time;
            $totalpay = $totalpay+$ord->total_price;
        }

        $dates = DB::connection('mysql_sec')->table('orders')
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

    public function dboyRequestForPayment(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $user = auth('driver_api')->user();
        $dboy_id = $user->dboy_id;
        $order_id =$request->order_id;
        DB::connection('mysql_sec')->table('orders')
            ->where('dboy_id','=',$dboy_id)->where('order_id','=',$order_id)->first();
        $update = DB::connection('mysql_sec')->table('orders')
                    ->where('dboy_id','=',$dboy_id)
                    ->where('order_id','=',$order_id)
                    ->update(['pay_by_dboy'=>'1']);

        return apiResponse(true,204,'Request Successfully Sent');
    }
}