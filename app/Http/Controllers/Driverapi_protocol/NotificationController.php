<?php

namespace App\Http\Controllers\Driverapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
   public function notificationlist(Request $request)
    {  
        $user = auth('driver_api')->user();
        $dboy_id = $user->dboy_id;
        $notifyby = DB::connection('mysql_sec')->table('driver_notification')
                ->where('dboy_id',$dboy_id)
                ->orderBy('noti_id','desc')
                ->get();
        return apiResponse(true,202,$notifyby);
    }
    
    public function read_by_store(Request $request)
    {  
        $noti_id = $request->noti_id;
        $notifyby = DB::connection('mysql_sec')->table('driver_notification')
                ->where('noti_id',$noti_id)
                ->update(['read_by_store'=> 1]);
                
         if($notifyby){
            $message = array('status'=>'1', 'message'=>'Read by Store');
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Not Found', 'data'=>[]);
            return $message;
        }
    }
    
     public function all_as_read(Request $request)
    {  
        $dboy_id = $request->dboy_id;
        $notifyby = DB::connection('mysql_sec')->table('driver_notification')
                ->where('dboy_id',$dboy_id)
                ->update(['read_by_store'=> 1]);
                
         if($notifyby){
            $message = array('status'=>'1', 'message'=>'Marked All as Read');
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Not Found', 'data'=>[]);
            return $message;
        }
    }
    
    
     public function delete_all(Request $request)
    {  
        $dboy_id = $request->dboy_id;
        $notifyby = DB::connection('mysql_sec')->table('driver_notification')
                ->where('dboy_id',$dboy_id)
                ->delete();
                
         if($notifyby){
            $message = array('status'=>'1', 'message'=>'All Notifications are Deleted');
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Not Found', 'data'=>[]);
            return $message;
        }
    }
}
