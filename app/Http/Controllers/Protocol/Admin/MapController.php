<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\WebSetting;
use DB;
use Auth;
use Session;
use Hash;


class MapController extends Controller
{
       public function mapsettings(Request $request)
    {
        
        $title="Map/Location Settings";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->first();	
                
          $g = DB::connection('mysql_sec')->table('map_api')
                ->first(); 

          $m = DB::connection('mysql_sec')->table('mapbox')
                ->first(); 
          $mset = DB::connection('mysql_sec')->table('map_settings')
                ->first();    
               
         return view('protocol.admin.settings.map',compact("admin_email","admin",'title','logo','g','m','mset'));
    }
 
 
 
 
    public function updategooglemap(Request $request)
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
        
        
        $check = DB::connection('mysql_sec')->table('map_api')
               ->first();
       
    
      if($check){
        $update = DB::connection('mysql_sec')->table('map_api')
                ->update(['map_api_key'=> $api_key]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('map_api')
                ->insert(['map_api_key'=> $api_key]);
               
      }
       $ue = DB::connection('mysql_sec')->table('map_settings')
                ->update(['mapbox'=> 0,'google_map'=> 1]);
     if($ue){
         
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
    
    public function updatemapbox(Request $request)
    {
        $mapbox = $request->mapbox;
        $this->validate(
            $request,
                [
                    'mapbox' => 'required'
                ],
                [
                    'mapbox.required' => 'Enter Mapbox API.',
                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('mapbox')
               ->first();
       
    
      if($check){
        

        $update = DB::connection('mysql_sec')->table('mapbox')
                ->update(['mapbox_api'=> $mapbox]);
    
      }
      else{
          $update = DB::connection('mysql_sec')->table('mapbox')
                ->insert(['mapbox_api'=> $mapbox]);
      }
       $ue = DB::connection('mysql_sec')->table('map_settings')
            ->update(['mapbox'=> 1,'google_map'=> 0]); 
                
     if($ue){
        
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
}