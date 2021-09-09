<?php

namespace App\Http\Controllers\Api_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class MapsetController extends Controller
{
   public function mapby(Request $request)
    {  
        $paymentvia = DB::connection('mysql_sec')->table('map_settings')
                   ->first();
                   
        if($paymentvia)   { 
            $message = array('status'=>'1', 'message'=>'map and places via', 'data'=>$paymentvia);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }
    }
    
    public function google_map(Request $request)
    {  
        $mapapi = DB::connection('mysql_sec')->table('map_API')
                   ->first();
                   
        if($mapapi)   { 
            $message = array('status'=>'1', 'message'=>'Google map api', 'data'=>$mapapi);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }
    }
    public function mapbox(Request $request)
    {  
        $mapapi = DB::connection('mysql_sec')->table('mapbox')
                   ->first();
                   
        if($mapapi)   { 
            $message = array('status'=>'1', 'message'=>'Mapbox api', 'data'=>$mapapi);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }
    }
}