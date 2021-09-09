<?php

namespace App\Http\Controllers\Api_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use JWTAuth;
use Auth;
use Carbon\Carbon;
use App\Activity;
class NotifybyController extends Controller
{
   public function notifyby(Request $request)
    {  
        $user_id = $request->user_id;
        $notifyby = DB::connection('mysql_sec')->table('notificationby')
                ->where('user_id',$user_id)
                ->first();
        
         if($notifyby){
            $message = array('status'=>'1', 'message'=>'Notifyby', 'data'=>$notifyby);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Not Found', 'data'=>[]);
            return $message;
        }
    }
    
    
    
    public function updatenotifyby(Request $request)
    {  
        $user_id = $request->user_id;
        $sms = $request->sms;
        $email = $request->email;
        $app = $request->app;
        $notifyby = DB::connection('mysql_sec')->table('notificationby')
                ->where('user_id',$user_id)
                ->update(['sms'=>$sms,
                'email'=>$email,
                'app'=>$app]);
        
         if($notifyby){
            $message = array('status'=>'1', 'message'=>'Updated Successfully', 'data'=>$notifyby);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Already Updated', 'data'=>[]);
            return $message;
        }
    }

    public function getUserActivity( Request $request){
        $aa = new Activity();
        $user = JWTAuth::toUser($request->token);
        $user_id    = $user->user_id;
        $data = $aa->getUserActivity($user_id);
        return apiResponse(true,202,$data);
        //return array('status'=>200,'message'=>'Notification List','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$data);
    }

    public function notificationlist(Request $request)
    {  
        $user = auth()->user();
        $user_id = $user->user_id;
        $notifyby = DB::connection('mysql_sec')->table('user_notification')
                ->where('user_id',$user_id)
                ->orderBy('not_id','desc')
                ->get();
        return apiResponse(true,202,$notifyby);
    }
}