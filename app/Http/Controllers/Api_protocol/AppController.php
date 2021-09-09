<?php

namespace App\Http\Controllers\Api_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AppController extends Controller
{
 
    public function app(Request $request)
    {
          $app = DB::connection('mysql_sec')->table('tbl_web_setting')
                      ->first();
                      
        if($app){
             return apiResponse(true, 200,$app);
        }else{
            return apiResponse(true, 204,'data not found');
        }
    }
    
    public function delivery_info(Request $request)
    {
          $del_fee = DB::connection('mysql_sec')->table('freedeliverycart')
                      ->first();
                      
        if($del_fee)   { 
            $message = array('status'=>'1', 'message'=>'Delivery fee and cart value', 'data'=>$del_fee);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }

        return $message;
    }
}
