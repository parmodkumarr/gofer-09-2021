<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ReasonController extends Controller
{
    public function can_res_list(Request $request)
    {
         $title = "Cancelling Reasons";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
        $reason = DB::connection('mysql_sec')->table('cancel_for')
                ->get();
                
        return view('protocol.admin.reasons.reasonlist', compact('title','reason','admin','logo'));    
        
        
    }
    public function can_res_add(Request $request)
    {
        $title = "Add Cancelling Reasons";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
         $reasons = DB::connection('mysql_sec')->table('cancel_for')
                ->get();
                
        return view('protocol.admin.reasons.reasonadd', compact('title','reasons','admin','logo'));    
        
        
    }
    public function can_res_added(Request $request)
    {
       
        $reason = $request->reason;
        
        
        $this->validate(
            $request,
                [
                    
                    'reason'=>'required',
                   
                   
                ],
                [
                    
                    'reason.required'=>'Reason Required',
            
                ]
        );
        
    	$insert = DB::connection('mysql_sec')->table('cancel_for')
                    ->insert([
                        'reason'=>$reason
                        ]);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }

    }
    
    public function can_res_edit(Request $request)
    {
         $title = "Cancellin reason edit";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
        $res_id = $request->res_id;

        $reason = DB::connection('mysql_sec')->table('cancel_for')
                ->where('res_id',$res_id)
                ->first();
                
        return view('protocol.admin.reasons.reasonedit', compact('title','reason','admin','logo'));    
        
        
    }
    
    public function can_res_edited(Request $request)
    {
        $reason = $request->reason;
       
        $res_id = $request->res_id;
        
        $this->validate(
            $request,
                [
                    
                    'reason'=>'required',
                  
                ],
                [
                    
                    'reason.required'=>'Enter reason',
                ]
        );
        
    	 $insert = DB::connection('mysql_sec')->table('cancel_for')
    	            ->where('res_id',$res_id)
                    ->update([
                        'reason'=>$reason
                        ]);
                    
     
        return redirect()->back()->withSuccess('Updated Successfully');
    }
    
    public function can_res_del(Request $request)
    {
        
        $res_id=$request->res_id;

    	$delete=DB::connection('mysql_sec')->table('cancel_for')->where('res_id',$res_id)->delete();
        if($delete)
        {
        return redirect()->back()->withSuccess('Deleted successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Something Wents Wrong'); 
        }
    }
}