<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class SecretloginController extends Controller
{
 public function secretlogin(Request $request)
    {
        $id=$request->id;
        $checkstoreLogin = DB::connection('mysql_sec')->table('store')
    	                   ->where('store_id',$id)
    	                   ->first();

    	if($checkstoreLogin){

           session::put('bamaStore',$checkstoreLogin->email);
           return redirect()->route('storeHome');
         
    	}else
         {
         	 return redirect()->back()->withErrors('Something Wents Wrong');
         }
    }
    
}