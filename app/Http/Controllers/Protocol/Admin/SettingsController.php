<?php
namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class SettingsController extends Controller
{
   
     public function app_details(Request $request)
    {
        
        $title="Global Settings";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->first();	
        $cc = DB::connection('mysql_sec')->table('country_code')
            ->first();
        $currency = DB::connection('mysql_sec')->table('currency')
            ->first();  
         return view('protocol.admin.settings.app_details',compact("admin_email","admin",'title','logo','cc','currency'));
      

    }
 
    public function updateappdetails(Request $request)
    {
        $this->validate(
            $request,
                [
                    'app_name' => 'required',
                    'country_code'=>'required'
                ],
                [
                    'app_name.required' => 'Enter App Name.',
                    'country_code.required'=> 'Enter Country Code'
                ]
        );
        
        $country_code = $request->country_code;
        $check = DB::connection('mysql_sec')->table('tbl_web_setting')
               ->first();
        $app_name = $request->app_name;
          $date = date('d-m-Y');
        if($check){
        $oldapplogo = $check->icon;
        $oldfavicon = $check->favicon;
        }
        
         if($request->hasFile('app_icon')){
            $app = $request->app_icon;
            $fileName = $app->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $app->move('images/app_logo/'.$date.'/', $fileName);
            $app = 'images/app_logo/'.$date.'/'.$fileName;
        }
        else{
            $app = $oldapplogo;
        }
        if($check->favicon != NULL){
        
         if($request->hasFile('favicon')){
            $favicon = $request->favicon;
            $fileName = $favicon->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $favicon->move('images/app_logo/favicon/'.$date.'/', $fileName);
            $favicon = 'images/app_logo/favicon/'.$date.'/'.$fileName;
        }
        else{
            $favicon = $oldfavicon;
        }
        }
        else{
            if($request->hasFile('favicon')){
            $favicon = $request->favicon;
            $fileName = $favicon->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $favicon->move('images/app_logo/favicon/'.$date.'/', $fileName);
            $favicon = 'images/app_logo/favicon/'.$date.'/'.$fileName;
        }
        else{
            $favicon = $oldapplogo;
        } 
        }
        
        $check2 = DB::connection('mysql_sec')->table('country_code')
               ->first();
       if($check2){
        $updatecc = DB::connection('mysql_sec')->table('country_code')
                ->update(['country_code'=> $country_code]);
      }
      else{
          $updatecc = DB::connection('mysql_sec')->table('country_code')
                ->insert(['country_code'=> $country_code]);
      } 
        $app_data = array(
            'name' =>$app_name,
            'icon' =>$app,
            'favicon'=>$favicon,
            'primary_color'=>$request->primary_color,
            'secondary_color'=>$request->secondary_color,
            'topbar_color'=>$request->topbar_color,
            'splashscreen_color'=>$request->splashscreen_color,
            'store_id'=>$request->store_id,
            'font_family'=>$request->font_family,
            'button_shapes'=>$request->button_shapes,
            'button_color'=>$request->button_color,
          );
        //echo"<pre>";print_r($app_data);die;
      if($check){
        $update = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->update($app_data);
      }else{
          $update = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->insert($app_data);
      }
      //print_r($update);die;
      if($update){
        return redirect()->back()->withSuccess('Updated Successfully');
      }else{
        if($updatecc){
          return redirect()->back()->withSuccess('Updated Successfully');
        }else{
          return redirect()->back()->withErrors('Already Updated');
        }  
      }
    }
    
    
    
     public function msg91(Request $request)
    {
        
        $title="SMS/OTP By";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->first();	
                
          $msg91 = DB::connection('mysql_sec')->table('msg91')
                ->first();   
          $twilio = DB::connection('mysql_sec')->table('twilio')
                ->first(); 
            $smsby = DB::connection('mysql_sec')->table('smsby')
                ->first(); 
            $firebase = DB::connection('mysql_sec')->table('firebase')
                      ->first();
         return view('protocol.admin.settings.msg91',compact("admin_email","admin",'title','logo','msg91','twilio','smsby','firebase'));
      

    }
 
    public function updatemsg91(Request $request)
    {
         $sender = $request->sender_id;
        $api_key = $request->api;
        $this->validate(
            $request,
                [
                    'sender_id' => 'required',
                    'api'=>'required',
                ],
                [
                    'sender_id.required' => 'Enter Sender ID.',
                    'api.required' =>'Enter api key',
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('msg91')
               ->first();
       
    
      if($check){
        $update = DB::connection('mysql_sec')->table('msg91')
                ->update(['sender_id'=> $sender,'api_key'=> $api_key,'active'=>1]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('msg91')
                ->insert(['sender_id'=> $sender,'api_key'=> $api_key,'active'=>1]);
      }
     if($update){
         $ue = DB::connection('mysql_sec')->table('smsby')
                ->update(['msg91'=> 1,'twilio'=> 0,'status'=>1]);
         $deactivetwilio = DB::connection('mysql_sec')->table('twilio')
                ->update(['active'=>0]);        
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
    
    
    
      public function mapapi(Request $request)
    {
        
        $title="Google Map API";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->first();	
                
            $map = DB::connection('mysql_sec')->table('map_API')
                ->first();   
         return view('protocol.admin.settings.map_api',compact("admin_email","admin",'title','logo','map'));
      

    }
 
    public function updatemap(Request $request)
    {
        $api_key = $request->api;
        $this->validate(
            $request,
                [
                    'api'=>'required',
                ],
                [
                    'api.required' =>'Enter api key',
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('map_API')
               ->first();
       
    
      if($check){
        

        $update = DB::connection('mysql_sec')->table('map_API')
                ->update(['map_api_key'=> $api_key]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('map_API')
                ->insert(['map_api_key'=> $api_key]);
      }
     if($update){
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Something Wents Wrong');
     }
    }
     
  
 public function fcm(Request $request)
    {
        
        $title="App Settings";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->first();	
                
            $fcm = DB::connection('mysql_sec')->table('fcm')
                ->first();
            $city=DB::connection('mysql_sec')->table('time_slot')
                 ->first();
                 
            $del_charge = DB::connection('mysql_sec')->table('freedeliverycart')
                 ->first();  
                 
             $pymnt = DB::connection('mysql_sec')->table('payment_via')
                ->first();
                
             $minmax = DB::connection('mysql_sec')->table('minimum_maximum_order_value')
                ->first();
         return view('protocol.admin.settings.app_setting',compact("admin_email","admin",'title','logo','fcm','city','del_charge','pymnt','minmax'));
      

    }
 
    public function updatefcm(Request $request)
    {
        $fcm = $request->fcm;
         $fcm2 = $request->fcm2;
          $fcm3 = $request->fcm3;
        $this->validate(
            $request,
                [
                    'fcm'=>'required',
                    'fcm2'=>'required',
                    'fcm3'=>'required',
                ],
                [
                    'fcm.required' =>'Enter User App FCM server key',
                    'fcm2.required'=>'Enter Store App FCM server key',
                    'fcm3.required'=>'Enter Store App FCM server key',
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('fcm')
               ->first();
       
    
      if($check){
        

        $update = DB::connection('mysql_sec')->table('fcm')
                ->update(['server_key'=> $fcm,
                'store_server_key'=>$fcm2,
                'driver_server_key'=>$fcm3]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('fcm')
                ->insert(['server_key'=> $fcm,
                'store_server_key'=>$fcm2,
                'driver_server_key'=>$fcm3]);
      }
     if($update){
        return redirect()->back()->withSuccess('FCM server Keys Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Something Wents Wrong');
     }
    }
  
 
    public function updatedel_charge(Request $request)
    {
        $del_charge = $request->del_charge;
        $min_cart_value = $request->min_cart_value;
        $this->validate(
            $request,
                [
                    'del_charge'=>'required',
                    'min_cart_value'=>'required',
                ],
                [
                    'del_charge.required' =>'Enter delivery charge',
                    'min_cart_value.required'=>'Enter Minimum Cart Value'
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('freedeliverycart')
               ->first();
       
    
      if($check){
        

        $update = DB::connection('mysql_sec')->table('freedeliverycart')
                ->update(['min_cart_value'=> $min_cart_value,
                'del_charge'=>$del_charge]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('freedeliverycart')
                ->insert(['min_cart_value'=> $min_cart_value,
                 'del_charge'=>$del_charge]);
      }
     if($update){
        return redirect()->back()->withSuccess('Delivery Charge Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Something Wents Wrong');
     }
    }
     
        
    
 
    public function updatecurrency(Request $request)
    {
        $currency_sign = $request->currency_sign;
        $currency_name = $request->currency_name;
        $this->validate(
            $request,
                [
                    'currency_sign'=>'required',
                    'currency_name'=>'required',
                ],
                [
                    'currency_sign.required' =>'Enter Currency Sign',
                    'currency_name'=>'Enter Currency Name',
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('currency')
               ->first();
       
    
      if($check){
        

        $update = DB::connection('mysql_sec')->table('currency')
                ->update(['currency_sign'=> $currency_sign, 'currency_name'=> $currency_name]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('currency')
                ->insert(['currency_sign'=> $currency_sign, 'currency_name'=> $currency_name]);
      }
     if($update){
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Something Wents Wrong');
     }
    }
     
         public function prv(Request $request)
    {
        
        $title="Edit Payout Request Validation";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();	
                
            $prv = DB::connection('mysql_sec')->table('payout_req_valid')
                ->first();   
         return view('protocol.admin.settings.payoutreq_validation',compact("admin_email","admin",'title','logo','prv'));
      

    }
 
    public function updateprv(Request $request)
    {
        $min_amt = $request->min_amt;
        $min_days = $request->min_days;
        $this->validate(
            $request,
                [
                    'min_amt' => 'required',
                    'min_days'=>'required',
                ],
                [
                    'min_amt.required' => 'Enter minimum amount.',
                    'min_days.required' =>'Enter minimum days',
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('payout_req_valid')
               ->first();
       
    
      if($check){
        

        $update = DB::connection('mysql_sec')->table('payout_req_valid')
                ->update(['min_amt'=> $min_amt,'min_days'=> $min_days]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('payout_req_valid')
                ->insert(['min_amt'=> $min_amt,'min_days'=> $min_days]);
      }
     if($update){
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Something Wents Wrong');
     }
    } 
    
    public function app_design(Request $request)
    {
      if($request->method() =='POST'){
        $data = $request->except('_token');
        if(isset($request->logo)){

        }
        DB::connection('mysql_sec')->table('app_design')->insert($data);
        return redirect()->back()->withSuccess('Updated Successfully');
      }else{
        $title="App Design Setting";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')
             ->where('admin_email',$admin_email)
             ->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        return view('protocol.admin.settings.app_design',compact("admin_email","admin",'title','logo'));
      }
    }
     
}
