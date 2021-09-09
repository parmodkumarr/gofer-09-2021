<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ApprovalController extends Controller
{
    public function storeclist(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
        $city = DB::connection('mysql_sec')->table('store')
                ->leftJoin('store_doc', 'store.store_id','=','store_doc.store_id')
                ->select('store.*','store_doc.document')
                ->where('store.admin_approval', 0)
                ->get();
                
        return view('protocol.admin.store.approval_wait', compact('title','city','admin','logo'));    
        
        
    }
    
    public function storeapproved(Request $request)
    {
  
        $store_id = $request->id;
         $store = DB::connection('mysql_sec')->table('store')
                ->where('store_id',$store_id)
                ->update(['admin_approval'=>1]);
    if($store){   
    return redirect()->back()->withSuccess('Store Approved Successfully');
    }
    else{
      return redirect()->back()->withErrors('Something Wents Wrong');   
    }
    }
}