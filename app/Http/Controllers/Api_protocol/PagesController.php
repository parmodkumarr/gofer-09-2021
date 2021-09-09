<?php

namespace App\Http\Controllers\Api_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PagesController extends Controller
{
 
    public function appaboutus(Request $request)
    {
          $about_us = DB::connection('mysql_sec')->table('aboutuspage')
                      ->first();
                      
        if($about_us)   { 
            $message = array('status'=>'1', 'message'=>'About us', 'data'=>$about_us);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }

        return $message;
    }
    
    
    public function appterms(Request $request)
    {
          $terms = DB::connection('mysql_sec')->table('termspage')
                      ->first();
                      
        if($terms)   { 
            $message = array('status'=>'1', 'message'=>'Terms & Condition', 'data'=>$terms);
            return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
            return $message;
        }

        return $message;
    }

    public function pageContent(Request $request)
    {
        $data =array(
            'appAboutUs'=>route('appAboutUs'),
            'AppTerm'=>route('AppTerm'),
            'AppFaqs'=>route('AppFaqs'),
        );

        return apiResponse(true, 200, $data);
    }
}
