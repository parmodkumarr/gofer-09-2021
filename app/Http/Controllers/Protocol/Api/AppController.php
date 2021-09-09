<?php

namespace App\Http\Controllers\Protocol\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AppController extends Controller
{
 
    public function app(Request $request)
    {
          $app = DB::connection('mysql_sec')->table('tbl_web_setting')
                      ->first();
                      
        if($app)   { 
            $message = array('status'=>'1', 'message'=>'App Name & Logo', 'data'=>$app);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }

        return $message;
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
