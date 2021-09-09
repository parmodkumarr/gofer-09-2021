<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function adminNotification(Request $request)
    {
        $title = "To App Users";
        $admin_email=Session::get('bamaAdmin');
         $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();	

        return view('protocol.admin.settings.notification',compact("title","admin","logo","admin"));
    }


        public function adminNotificationSend(Request $request)
    {
        $this->validate(
            $request,
                [
                    'notification_title' => 'required',
                    'notification_text' => 'required',
             
                ],
                [
                    'notification_title.required' => 'Enter notification title.',
                    'notification_text.required' => 'Enter notification text.',
                ]
        );

        $notification_title = $request->notification_title;
        $notification_text = $request->notification_text;

        $getDevice = DB::connection('mysql_sec')->table('users')
            ->where('device_id', '!=', null)
            ->select('device_id','user_id')->groupBy('device_id')->get();

        if(count($getDevice) == 0){
            return redirect()->back()->withErrors('something wents wrong');
        }
        
        foreach ($getDevice as $getDevices) {
            $userid = $getDevices->user_id;
            userNoctification($notification_title, $notification_text,$userid);
        }
        return redirect()->back()->withSuccess('notification send successfully');
    }

    public function adminNotificationSend_old(Request $request)
    {
        $this->validate(
            $request,
                [
                    'notification_title' => 'required',
                    'notification_text' => 'required',
             
                ],
                [
                    'notification_title.required' => 'Enter notification title.',
                    'notification_text.required' => 'Enter notification text.',
                ]
        );

        $notification_title = $request->notification_title;
        $notification_text = $request->notification_text;
        
        $date = date('d-m-Y');

    


            $getUser = DB::connection('mysql_sec')->table('users')
                        ->get();

            $getDevice = DB::connection('mysql_sec')->table('users')
                        ->where('device_id', '!=', null)
                        ->select('device_id')
                        ->groupBy('device_id')
                        ->get();
                        
        $created_at = Carbon::now();

        if(count($getDevice) == 0){
            return redirect()->back()->withErrors('something wents wrong');
        }

        
        $getFcm = DB::connection('mysql_sec')->table('fcm')
                    ->where('id', '1')
                    ->first();
                    
        $getFcmKey = $getFcm->server_key;
        
        foreach ($getDevice as $getDevices) {
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $getDevices->device_id;;
            

            $notification = [
                'title' => $notification_title,
                'body' => $notification_text,
                'sound' => true,
            ];
            
            $extraNotificationData = ["message" => $notification];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData,
            ];

            $headers = [
                'Authorization: key='.$getFcmKey,
                'Content-Type: application/json'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
        }
        $results = json_decode($result);
         foreach ($getUser as $getUsers) {
            $insertNotification = DB::connection('mysql_sec')->table('user_notification')
                                    ->insert([
                                        'user_id'=>$getUsers->user_id,
                                        'noti_title'=>$notification_title,
                                        'noti_message'=>$notification_text,
                                      
                                    ]);
        }
        return redirect()->back()->withSuccess('notification send successfully');
    }
    
    
    
     public function Notification_to_store(Request $request)
    {
        $title = "To Store";
        $admin_email=Session::get('bamaAdmin');
         $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();	

        return view('protocol.admin.settings.notification_to_store',compact("title","admin","logo","admin"));
    }

    public function Notification_to_store_Send(Request $request)
    {
        $this->validate(
            $request,
                [
                    'notification_title' => 'required',
                    'notification_text' => 'required',
                ],
                [
                    'notification_title.required' => 'Enter notification title.',
                    'notification_text.required' => 'Enter notification text.',
                ]
        );

        $notification_title = $request->notification_title;
        $notification_text = $request->notification_text;

        $getUser = DB::connection('mysql_sec')->table('store')->get();

        $getDevice = DB::connection('mysql_sec')->table('store')
            ->where('device_id', '!=', null)
            ->select('device_id','store_id')->groupBy('device_id')->get();
                        
        $created_at = Carbon::now();

        if(count($getDevice) == 0){
            return redirect()->back()->withErrors('something wents wrong');
        }

        
        $getFcm = DB::connection('mysql_sec')->table('fcm')
                    ->select('store_server_key')
                    ->where('id', '1')
                    ->first();
                    
        $getFcmKey = $getFcm->store_server_key;
        
        foreach ($getDevice as $getDevices) {
            $storeid = $getDevices->store_id;
            storeNoctification($notification_title, $notification_text, $storeid);
        }

        return redirect()->back()->withSuccess('notification send to store successfully');
    }

    public function Notification_to_store_Send_old(Request $request)
    {
        $this->validate(
            $request,
                [
                    'notification_title' => 'required',
                    'notification_text' => 'required',
             
                ],
                [
                    'notification_title.required' => 'Enter notification title.',
                    'notification_text.required' => 'Enter notification text.',
                ]
        );

        $notification_title = $request->notification_title;
        $notification_text = $request->notification_text;
        
        $date = date('d-m-Y');

    


            $getUser = DB::connection('mysql_sec')->table('store')
                        ->get();

            $getDevice = DB::connection('mysql_sec')->table('store')
                        ->where('device_id', '!=', null)
                        ->select('device_id')
                        ->groupBy('device_id')
                        ->get();
                        
        $created_at = Carbon::now();

        if(count($getDevice) == 0){
            return redirect()->back()->withErrors('something wents wrong');
        }

        
        $getFcm = DB::connection('mysql_sec')->table('fcm')
                    ->select('store_server_key')
                    ->where('id', '1')
                    ->first();
                    
        $getFcmKey = $getFcm->store_server_key;
        
        foreach ($getDevice as $getDevices) {
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $getDevices->device_id;;
            

            $notification = [
                'title' => $notification_title,
                'body' => $notification_text,
                'sound' => true,
            ];
            
            $extraNotificationData = ["message" => $notification];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData,
            ];

            $headers = [
                'Authorization: key='.$getFcmKey,
                'Content-Type: application/json'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
        }
        foreach ($getUser as $getUsers) {
            $insertNotification = DB::connection('mysql_sec')->table('store_notification')
                                    ->insert([
                                        'store_id'=>$getUsers->store_id,
                                        'not_title'=>$notification_title,
                                        'not_message'=>$notification_text,
                                      
                                    ]);
        }
        $results = json_decode($result);

        return redirect()->back()->withSuccess('notification send to store successfully');
    }

    public function stockRequestList(Request $request){
         $title = "To App Users";
        $admin_email=Session::get('bamaAdmin');
         $admin= DB::connection('mysql_sec')->table('admin')
                   ->where('admin_email',$admin_email)
                   ->first();
          $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();  
        $requestq = DB::connection('mysql_sec')->table('admin_notification')
                ->join('store', 'store.store_id', '=', 'admin_notification.store_id')
                ->join('product_varient', 'store.store_id', '=', 'product_varient.varient_id')
                ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                ->select('admin_notification.*','product_varient.quantity AS product_quantity','store.store_name','store.email','store.phone_number','store.owner_id','product.product_name','product_varient.product_id')
                ->get();
        //echo"<pre>";print_r($requestq);die;
        return view('protocol.admin.stock_request.list',compact("title","admin","logo","admin","requestq"));
    }

    public function AllocateStock(Request $request){
        $varient_id = $request->varient_id;
        $product_id = $request->product_id;
        $store_id = $request->store_id;
        $allocated_quantity = $request->allocated_quantity;
        $not_id = $request->not_id;

        $data['allocated_quantity'] =$allocated_quantity;

        DB::connection('mysql_sec')->table('admin_notification')->where('not_id', $not_id)->update($data);

        $store =DB::connection('mysql_sec')->table('store_products')
        ->where(['varient_id'=>$varient_id,'store_id'=>$store_id])->first();

        $data2['stock']=$store->stock +$allocated_quantity;
        DB::connection('mysql_sec')->table('store_products')
        ->where(['varient_id'=>$varient_id,'store_id'=>$store_id])->update($data2);

        $adminstock = DB::connection('mysql_sec')->table('product_varient')
                ->where(['varient_id'=>$varient_id])->first();

        $data3['quantity'] =$adminstock-$allocated_quantity;
        DB::connection('mysql_sec')->table('product_varient')
                ->where(['varient_id'=>$varient_id])->update($data3);
        $data4['stock'] = $data3['quantity'];
        DB::connection('mysql_sec')->table('store_products')
                ->where(['varient_id'=>$varient_id,'store_id'=>0])->update($data4);

        return redirect()->back()->withSuccess('Stock Allocated to store successfully');
    }
    
}
