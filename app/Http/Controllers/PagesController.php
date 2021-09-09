<?php

namespace App\Http\Controllers;

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


    public function aboutus(Request $request)
    {
        $about_us = DB::connection('mysql_sec')->table('aboutuspage')->first();
        return view('protocol.aboutus',compact('about_us'));
    }
    
    public function appfaqs(Request $request)
    {
        $faqs = DB::connection('mysql_sec')->table('faqs')->first();
        return view('protocol.faqs',compact('faqs'));
    }

    public function terms(Request $request)
    {
        $terms = DB::connection('mysql_sec')->table('termspage')->first();
        return view('protocol.terms',compact('terms'));
    }
}
