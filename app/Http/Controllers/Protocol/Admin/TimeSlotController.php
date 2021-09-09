<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class TimeSlotController extends Controller
{

    public function timeslot(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        $time_slot_id = $request->time_slot_id;
        
        $city = DB::connection('mysql_sec')->table('time_slot')
                
                ->first();
                
                
        return view('protocol.admin.time_slot.time_slotadd', compact('title',"city",'admin','logo'));    
        
        
    }

    
    public function timeslotupdate(Request $request)
    {
        $title = "Home";
        // $time_slot_id = $request->time_slot_id;
        $open_hrs = $request->open_hrs;
        $close_hrs = $request->close_hrs;
        $interval = $request->interval;
        

    	 $insert = DB::connection('mysql_sec')->table('time_slot')
    	           // ->where('time_slot_id',$time_slot_id)
                    ->update([
                        'open_hour'=>$open_hrs,
                        'close_hour'=>$close_hrs,
                        'time_slot'=>$interval
                        ]);
     
         return redirect()->back()->withSuccess('Updated Successfully');

    }

    // public function timeslot_list(Request $request){
    //   $timeslot =  DB::connection('mysql_sec')->table('store_time_slot')
    //     ->where('store_id','')->get();
    //     return view('protocol.admin.time.list', compact('timeslot'));
    // }

    public function add_timeslot($id=null,Request $request){
        if($request->method() =="POST"){
            $this->validate(
            $request,
                [
                    //'store_id'=>'required',
                    'day'=>'required',
                    'opening_time'=>'required',
                    'closing_time'=>'required',
                    'time_slot'=>'required',
                    'status'=>'required',
                ]
            );
           $data = $request->except('_token');
           $msg ="Add";
           if($id!=null){
                DB::connection('mysql_sec')->table('store_time_slot')
                ->where('id',$id)->update($data);
                $msg ="Update";
           }else{
                DB::connection('mysql_sec')->table('store_time_slot')->insert($data);
           }
           return redirect()->back()->withSuccess("$msg Successfully");
        }else{
            //DaysNum()
            $days = array(
                'Sun',
                'Mon',
                'Tues',
                'Wed',
                'Thurs',
                'Fri',
                'Sat'
            );
            
            $title = "Add Store Time";
            $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')->first();
            $admin_email=Session::get('bamaAdmin');
            $admin= DB::connection('mysql_sec')->table('admin')
                ->where('admin_email',$admin_email)->first();
            $timeslot =  DB::connection('mysql_sec')->table('store_time_slot')
                ->where('store_id',NULL)->get();
            $times = DB::connection('mysql_sec')->table('store_time_slot')
                ->where('id', $id)->first();
            //echo "<pre>";print_r($times);die;
            return view('protocol.admin.time.add',compact('logo','title','admin','timeslot','days','times','id'));
        }
    }

    public function delete_timeslot($id,Request $request){
        DB::connection('mysql_sec')->table('store_time_slot')
        ->where('id',$id)->delete();
        return redirect()->back()->withSuccess("Delete Successfully");
    }

}