<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class PagesController extends Controller
{
    public function about_us(Request $request)
    {
        $title = "About Us";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
          $check = DB::connection('mysql_sec')->table('aboutuspage')
                ->first();
    	return view('protocol.admin.about_us', compact('title',"admin", "logo", "check"));
    }
    
    
     public function updateabout_us(Request $request)
    {
        $title="About Us";
        $description = $request->description;
         $check = DB::connection('mysql_sec')->table('aboutuspage')
                ->first();
                
        if($check){
            $update = DB::connection('mysql_sec')->table('aboutuspage')
                    ->update(['description'=>$description]);
        }   
        else{
            $update = DB::connection('mysql_sec')->table('aboutuspage')
                    ->insert(['title'=>$title,
                    'description'=>$description]);
        }
     if($update){
          return redirect()->back()->withSuccess('About-us Updated successfully');
     }            
     else{
          return redirect()->back()->withErrors('something went wrong');
     }
    }
    
    public function terms(Request $request)
    {
        $title = "Terms & Condition";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
          $check = DB::connection('mysql_sec')->table('termspage')
                ->first();
    	return view('protocol.admin.terms', compact('title',"admin", "logo", "check"));
    }
    
    
     public function updateterms(Request $request)
    {
        $title="Terms & Condition";
        $description = $request->description;
         $check = DB::connection('mysql_sec')->table('termspage')
                ->first();
                
        if($check){
            $update = DB::connection('mysql_sec')->table('termspage')
                    ->update(['description'=>$description]);
        }   
        else{
            $update = DB::connection('mysql_sec')->table('termspage')
                    ->insert(['title'=>$title,
                    'description'=>$description]);
        }
     if($update){
          return redirect()->back()->withSuccess('Terms & Conditions Updated successfully');
     }            
     else{
          return redirect()->back()->withErrors('something went wrong');
     }
    }



    public function faqs(Request $request)
    {
        $title = "Faqs";
         $admin_email=Session::get('bamaAdmin');
       $admin= DB::connection('mysql_sec')->table('admin')
             ->where('admin_email',$admin_email)
             ->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
          $check = DB::connection('mysql_sec')->table('faqs')
                ->first();
      return view('protocol.admin.faqs', compact('title',"admin", "logo", "check"));
    }
    
    
     public function updatefaqs(Request $request)
    {
        $title="About Us";
        $description = $request->description;
         $check = DB::connection('mysql_sec')->table('faqs')
                ->first();
                
        if($check){
            $update = DB::connection('mysql_sec')->table('faqs')
                    ->update(['description'=>$description]);
        }   
        else{
            $update = DB::connection('mysql_sec')->table('faqs')
                    ->insert(['title'=>$title,
                    'description'=>$description]);
        }
     if($update){
          return redirect()->back()->withSuccess('About-us Updated successfully');
     }            
     else{
          return redirect()->back()->withErrors('something went wrong');
     }
    }


}
