<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Activity;
class HomeController extends Controller
{
    public function adminHome(Request $request)
    {
        $title = "Dashboard";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
            $total_earnings=DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','4')
                           ->sum('total_price');
                           
            $completed_orders =  DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','4')
                           ->count();
                           
            $app_users =DB::connection('mysql_sec')->table('users')
                       ->count();
            
            $stores = DB::connection('mysql_sec')->table('store')
                       ->count();          
        
        
            $pending =   DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','1')
                           ->orWhere('order_status','2')
                           ->orWhere('order_status','3')
                           ->count();
                           
                           
            $cancelled = DB::connection('mysql_sec')->table('orders')
                           ->where('order_status','0')
                           ->count();   
                           
                           
            $delivery_boys = DB::connection('mysql_sec')->table('delivery_boy')
                           ->count();
                           
            $city = DB::connection('mysql_sec')->table('city')
                   ->count();
    	return view('protocol.admin.home', compact('title',"admin", "logo","total_earnings","completed_orders","app_users","stores","pending","cancelled","delivery_boys","city"));
    }





   public function hitFireBase(Request $request){

      $message = "for test purpose";
      $title = "for test purpose";


      $device_id = 'dM2SoiZSS_e6gF2eNpv-y1:APA91bGaYNUHGqsB6Fxn-e-9KUy-MKnWWejyUp3uxLFZfwaRdFAu24Lixt0cq91MOL23j5r54kJ7CCi3HxK9y2mxVGDJQis8EYvmZxvb4rliQL_kfb0I4aMrYushmeCipo3j8nvys-J9';
      
      $aa = new Activity();
      $aa->userActivity($title,$message,$device_id);
      // //API URL of FCM
      // $url = 'https://fcm.googleapis.com/fcm/send';

      // $api_key = '';


               
      // $fields = array (
      //    'registration_ids' => array (
      //          $device_id
      //    ),
      //    "notification" => array(
      //       "title"=>$title,
      //       "body"=>$message
      //    )
      // );

      // //header includes Content type and api key
      // $headers = array(
      //    'Content-Type:application/json',
      //    'Authorization:key='.$api_key
      // );
               
               
      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, $url);
      // curl_setopt($ch, CURLOPT_POST, true);
      // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      // $result = curl_exec($ch);
      // if ($result === FALSE) {
      //    die('FCM Send Error: ' . curl_error($ch));
      // }
      // curl_close($ch);
      // return $result;
      return 'done';
   }
}
