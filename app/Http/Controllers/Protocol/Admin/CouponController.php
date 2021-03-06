<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class CouponController extends Controller
{
    public function couponlist(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        $coupon= DB::connection('mysql_sec')->table('coupon')
                ->get();
        return view('protocol.admin.coupon.couponlist',compact("title","coupon",'admin','logo'));
    }


    public function Bulkcoupon(Request $request){
        $title = "Home";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')
            ->where('admin_email',$admin_email)->first();

        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')->first();

         return view('protocol.admin.coupon.couponaddbulk',compact("title",'admin','logo'));
    }

    public function Bulkaddcoupon(Request $request)
    {
        $coupon_name = $request->coupon_name;
        // $coupon_code = $request->coupon_code;
        $coupon_desc = $request->coupon_desc;
        $valid_to = $request->valid_to;
        $valid_from = $request->valid_from;
        $cart_value = $request->cart_value;
        $coupon_type = $request->coupon_type;
        $coupon_discount = $request->coupon_discount;
        $restriction  = $request->restriction;
        $no_coupon    = $request->no_of_coupon;
        $prefix       = $request->prefix;
        $coupon_Length = $request->coupon_Length;
        $discount = str_replace("%",'', $coupon_discount);

        
      $this->validate(
            $request,
                [
                    'coupon_name'=>'required',
                    //'coupon_code'=>'required|unique:coupon',
                    'coupon_desc'=>'required',
                    'valid_to'=>'required',
                    'valid_from'=>'required',
                    'cart_value'=>'required',
                    'restriction'=>'required',
                    'no_of_coupon'=>'required',
                ],
                [
                    'coupon_name.required'=>'Coupon Name Required',
                    'coupon_code.required'=>'Coupon Code Required',
                    'coupon_desc.required'=>'Coupon Description Required',
                    'valid_to.required'=>'Date Required',
                    'valid_from.required'=>'Date Required',
                    'cart_value.required'=>'Cart value Required',
                    'restriction.required'=>'Enter Uses Restiction limit',
                ]
        );

    for ($i=0; $i < $no_coupon; $i++) { 
        $coupon_code=coupon_code($prefix,$coupon_Length);
        $insert = DB::connection('mysql_sec')->table('coupon')
            ->insert([
            'coupon_name'=>$coupon_name,
            'coupon_description'=>$coupon_desc,
            'coupon_code'=>$coupon_code,
            'start_date'=>$valid_to,
            'end_date'=>$valid_from,
            'type'=>$coupon_type,
            'uses_restriction'=>$restriction,
            'amount'=>$discount,
            'cart_value'=>$cart_value
            ]);
    }
    return redirect()->back()->withSuccess('Added Successfully');
    }
    
    public function coupon(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
       
        $coupon= DB::connection('mysql_sec')->table('coupon')
                ->get();
         return view('protocol.admin.coupon.couponadd',compact("title","coupon",'admin','logo'));
    }
    
    
    public function addcoupon(Request $request)
    {
        $coupon_name = $request->coupon_name;
        $coupon_code = $request->coupon_code;
        $coupon_desc = $request->coupon_desc;
        $valid_to = $request->valid_to;
        $valid_from = $request->valid_from;
        $cart_value = $request->cart_value;
        $coupon_type = $request->coupon_type;
        $coupon_discount =$request->coupon_discount;
        $restriction = $request->restriction;
        $discount = str_replace("%",'', $coupon_discount);

        
      $this->validate(
            $request,
                [
                    'coupon_name'=>'required',
                    'coupon_code'=>'required|unique:coupon',
                    'coupon_desc'=>'required',
                    'valid_to'=>'required',
                    'valid_from'=>'required',
                    'cart_value'=>'required',
                    'restriction'=>'required'
                ],
                [
                    'coupon_name.required'=>'Coupon Name Required',
                    'coupon_code.required'=>'Coupon Code Required',
                    'coupon_desc.required'=>'Coupon Description Required',
                    'valid_to.required'=>'Date Required',
                    'valid_from.required'=>'Date Required',
                    'cart_value.required'=>'Cart value Required',
                    'restriction.required'=>'Enter Uses Restiction limit'
                ]
        );


        $insert = DB::connection('mysql_sec')->table('coupon')
                  ->insert([
                       'coupon_name'=>$coupon_name,
                       'coupon_description'=>$coupon_desc,
                       'coupon_code'=>$coupon_code,
                       'start_date'=>$valid_to,
                       'end_date'=>$valid_from,
                       'type'=>$coupon_type,
                       'uses_restriction'=>$restriction,
                       'amount'=>$discount,
                       'cart_value'=>$cart_value]);
     
     return redirect()->back()->withSuccess('Added Successfully');

    }
    
    public function editcoupon(Request $request)
    {
    	 $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
         $coupon_id=$request->coupon_id;
    	 $coupon= DB::connection('mysql_sec')->table('coupon')
    	 		  ->where('coupon_id',$coupon_id)
    	 		  ->first();
    	 return view('protocol.admin.coupon.couponedit',compact("coupon","coupon_id","title",'admin','logo'));


    }
    public function updatecoupon(Request $request)
    {
   
        $coupon_id = $request->coupon_id;
        $coupon_name = $request->coupon_name;
        $coupon_code = $request->coupon_code;
        $coupon_type = $request->coupon_type;
        $coupon_desc = $request->coupon_desc;
        $valid_to = $request->valid_to;
        $valid_from = $request->valid_from;
        $cart_value = $request->cart_value;
        $restriction = $request->restriction;
        
      $this->validate(
            $request,
                [
                    
                    'coupon_name'=>'required',
                    'coupon_code'=>'required',
                    'coupon_desc'=>'required',
                    'valid_to'=>'required',
                    'valid_from'=>'required',
                    'cart_value'=>'required',
                    'restriction'=>'required'
                ],
                [
                    
                    'coupon_name.required'=>'Coupon Name Required',
                    'coupon_code.required'=>'Coupon Code Required',
                    'coupon_desc.required'=>'Coupon Description Required',
                    'valid_to.required'=>'Date Required',
                    'valid_from.required'=>'Date Required',
                    'cart_value.required'=>'Cart value Required',
                    'restriction.required'=>'Enter Uses Restiction limit'

                ]
        );
        $update = DB::connection('mysql_sec')->table('coupon')
                 ->where('coupon_id', $coupon_id)
                 ->update([
                      'coupon_name'=>$coupon_name,
                       'coupon_description'=>$coupon_desc,
                       'coupon_code'=>$coupon_code,
                       'start_date'=>$valid_to,
                       'type'=>$coupon_type,
                       'end_date'=>$valid_from,
                       'cart_value'=>$cart_value,
                       'uses_restriction'=>$restriction]);

        if($update){

             

            return redirect()->back()->withSuccess(' Updated Successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
  public function deletecoupon(Request $request)
    {
        
        
        $coupon_id=$request->coupon_id;

        $getfile=DB::connection('mysql_sec')->table('coupon')
                ->where('coupon_id',$coupon_id)
                ->first();


    	$delete=DB::connection('mysql_sec')->table('coupon')->where('coupon_id',$request->coupon_id)->delete();
        if($delete)
        {
         return redirect()->back()->withSuccess('Deleted Successfully');
            }
   
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	
    
}
