<?php

namespace App\Http\Controllers\Protocol\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class FirebaseController extends Controller
{
   public function firebase(Request $request)
    {  
        $firebase = DB::connection('mysql_sec')->table('firebase')
                ->first();
        
         if($firebase){
            $message = array('status'=>'1', 'message'=>'firebase status', 'data'=>$firebase);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'not available', 'data'=>[]);
            return $message;
        }
    }
    
    public function countrycode(Request $request)
    {  
        $countrycode = DB::connection('mysql_sec')->table('country_code')->first();
        
         if($countrycode){
            $message = array('status'=>'1', 'message'=>'country code', 'data'=>$countrycode);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'not available', 'data'=>[]);
            return $message;
        }
    }
     public function app_notice(Request $request)
    {  
        $app_notice = DB::connection('mysql_sec')->table('app_notice')
                ->first();
        
         if($app_notice){
            $message = array('status'=>'1', 'message'=>'app notice', 'data'=>$app_notice);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'not available', 'data'=>[]);
            return $message;
        }
    }
}