<?php
function apiResponse($success, $code, $reply, $extra = [])
{
    $response = [
    'status' => $code,
    'success' => $success,
    'message' => '',
    'image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/',
    'errors' => [],
    'result' => [],
    'result_obj' => new ArrayObject(),
    'extra' => $extra ? $extra : new ArrayObject(),
    ];

    if ($code == 200) {
    $response['result_obj'] = $reply;
    } elseif ($code == 404 || $code == 202) {
    $response['result'] = $reply;
    } elseif ($code == 406) {
    $response['errors'] = apiErrors($reply);
    } else {
    $response['message'] = $reply;
    }
    return response()->json($response);
}


function apiErrors($errors = [])
{
    $error = [];
    if(!is_array($errors)){
    $errors = $errors->toArray();
}

foreach ($errors as $key => $value)
{
$error[] =['key' => $key, 'value' => $value[0]];
//$error[] = $value[0];
}
return $error;
}

function testme(){
    return "hey there";
}

    function DaysNum(){
        return array(
        "1"=>'Sun',
        "2"=>'Mon',
        "3"=>'Tues',
        "4"=>'Wed',
        "5"=>'Thurs',
        "6"=>'Fri',
        "7"=>'Sat'
        );
    }

    function driverNoctification($title='', $message='', $dboy_id){
        //API URL of FCM
        $user = App\Driver::where('dboy_id','=',$dboy_id)->first();
        $device_id = $user->device_id;
        $data =array(
          'dboy_id'=>$user->dboy_id,
          'noti_title'=>$title,
          'noti_message'=>$message
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = env('FIREBASE_KEY');         
        $fields = array (
                'registration_ids' => array (
                    $device_id
                ),
                "notification" => array(
                "title"=>$title,
                "body"=>$message
                )
            );

        //header includes Content type and api key
        $headers = array(
         'Content-Type:application/json',
         'Authorization:key='.$api_key
        );
               
               
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        DB::connection('mysql_sec')->table('driver_notification')->insert($data);
        return $result;
    }

    function userNoctification($title='', $message='', $user_id){
        //API URL of FCM
        $user = App\User::where('user_id','=',$user_id)->first();
        $device_id = $user->device_id;
        $data =array(
          'user_id'=>$user->user_id,
          'noti_title'=>$title,
          'noti_message'=>$message
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = env('FIREBASE_KEY');         
        $fields = array (
                'registration_ids' => array (
                    $device_id
                ),
                "notification" => array(
                "title"=>$title,
                "body"=>$message
                )
            );

        //header includes Content type and api key
        $headers = array(
         'Content-Type:application/json',
         'Authorization:key='.$api_key
        );
               
               
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        DB::connection('mysql_sec')->table('user_notification')->insert($data);
        return $result;
    }

    function storeNoctification($title='', $message='', $store_id){
        //API URL of FCM
        $store = App\Store::where('store_id','=',$store_id)->first();
       //print_r($store_id);die;
        $device_id = $store->device_id;
        $data =array(
          'store_id'=>$store->store_id,
          'not_title'=>$title,
          'not_message'=>$message
        );

        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = env('FIREBASE_KEY');         
        $fields = array (
                'registration_ids' => array (
                    $device_id
                ),
                "notification" => array(
                "title"=>$title,
                "body"=>$message
                )
            );

        //header includes Content type and api key
        $headers = array(
         'Content-Type:application/json',
         'Authorization:key='.$api_key
        );
               
               
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        DB::connection('mysql_sec')->table('store_notification')->insert($data);
        return $result;
    }


    function addActivityLog($subject,$user_id = NULL, $user_role = NULL)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] =  \Request::fullUrl();
        $log['method'] = \Request::method();
        $log['ip'] =     \Request::ip();
        $log['agent'] = \Request::header('user-agent');
        $log['user_id'] = $user_id;
        $log['user_role'] =$user_role;
        App\Activity::create($log);
    }

    function ActivityLogsList()
    {
        return App\Activity::latest()->get();
    }


    function offerList($selected='')
    {
        $offer =  array(
                  "5"=>'Upto 5%',
                  "10"=>'Upto 10%',
                  "15"=>'Upto 15%',
                  "20"=>'Upto 20%',
                  "25"=>'Upto 25%',
                  "30"=>'Upto 30%',
                  "35"=>'Upto 35%',
                  "40"=>'Upto 40%',
                  "45"=>'Upto 45%',
                  "50"=>'Upto 50%',
                  "55"=>'Upto 55%',
                  "60"=>'Upto 60%',
                  "65"=>'Upto 65%',
                  "70"=>'Upto 70%',
                  "75"=>'Upto 75%',
                  "80"=>'Upto 80%',
                  "85"=>'Upto 85%',
                  "90"=>'Upto 90%',
                  "95"=>'Upto 95%',
                  "100"=>'Upto 100%'
                );
        $result = '';
        foreach($offer as $value=>$name){
           $select = ($value ==$selected) ? 'selected':'';
            $result .="<option value='$value' $select >$name</option>";
        }

        return $result;
    }


    function coupon_code($prefix="",$len=10){
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res   = preg_replace('/\s+/', '', $prefix);
        $i     = strlen($prefix);
        for ($i = 0; $i < $len; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;
    }

    function Prductsunits(){
        return ['units'=>'units','kg'=>'kg','gm'=>'gm','pc'=>'pc','L'=>'L','ml'=>'ml','plts'=>'plts'];
    }


    function getAddress($lat,$lng){
        $geolocation = $lat.','.$lng;
        $request = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyADlk166150RMLLGby78Ayq9kUKyAdHtp0&latlng='.$geolocation.'&sensor=false'; 
        $file_contents = file_get_contents($request);
        $json_decode = json_decode($file_contents);
        $response = array();
        if(isset($json_decode->results[0])) {
           // $response['full_address'] =$json_decode->results[0]->formatted_address;
            foreach($json_decode->results[0]->address_components as $addressComponet) {
                if(in_array('locality', $addressComponet->types)) {
                        $response['city'] = $addressComponet->long_name; 
                }
                // if(in_array('country', $addressComponet->types)) {
                //         $response['country'] = $addressComponet->long_name;
                // }

                if(in_array('postal_code', $addressComponet->types)) {
                        $response['pincode'] = $addressComponet->long_name;
                }

                if(in_array('administrative_area_level_1', $addressComponet->types)) {
                        $response['state'] = $addressComponet->long_name;
                }

                if(in_array('sublocality', $addressComponet->types)) {
                        $response['landmark'] = $addressComponet->long_name;
                }
            }
        }

        return $response;
    }
?>