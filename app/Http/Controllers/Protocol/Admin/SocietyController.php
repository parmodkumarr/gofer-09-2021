<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class SocietyController extends Controller
{
    public function societylist(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
        $city = DB::connection('mysql_sec')->table('society')
                ->join('city','society.city_id','=','city.city_id')
                ->get();
                
        return view('protocol.admin.society.societylist', compact('title','city','logo','admin'));    
        
        
    }
    public function society(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        
        $city = DB::connection('mysql_sec')->table('city')
                ->get();
            
          $map1 = DB::connection('mysql_sec')->table('map_API')
             ->first();
         $map = $map1->map_api_key;     
         $mapset = DB::connection('mysql_sec')->table('map_settings')
                 ->first();
                 
        $mapbox = DB::connection('mysql_sec')->table('mapbox')
                ->first();
        return view('protocol.admin.society.societyadd', compact('title','city','admin','logo','map','mapset','mapbox'));    
        
        
    }
    public function societyadd(Request $request)
    {
        $title = "Home";
        
        $society = $request->society;
        $city = $request->city;
        
        $this->validate(
            $request,
                [
                    
                    'society'=>'required',
                ],
                [
                    
                    'society.required'=>'Society Name Required',

                ]
        );
       
        
    	 $insert = DB::connection('mysql_sec')->table('society')
                    ->insert([
                        'society_name'=>$society,
                        'city_id'=>$city,
                        ]);
     
        return redirect()->back()->withSuccess('Added Successfully');

    }
    
    public function societyedit(Request $request)
    {
         $title = "Home";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        $society_id = $request->society_id;
        
        $cities = DB::connection('mysql_sec')->table('city')
                ->get();
        
        $city = DB::connection('mysql_sec')->table('society')
                ->where('society_id',$society_id)
                ->first();
          $map1 = DB::connection('mysql_sec')->table('map_API')
             ->first();
         $map = $map1->map_api_key;   
          $mapset = DB::connection('mysql_sec')->table('map_settings')
                 ->first();
                 
        $mapbox = DB::connection('mysql_sec')->table('mapbox')
                ->first();
        return view('protocol.admin.society.societyedit', compact('title','city','cities','admin','logo','map','mapset','mapbox'));    
        
        
    }
    
    public function societyupdate(Request $request)
    {
        $title = "Home";
        $society_id = $request->society_id;
        $society = $request->society;
        $city = $request->city;
        
         $this->validate(
            $request,
                [
                    
                    'society'=>'required',
                ],
                [
                    
                    'society.required'=>'Society Name Required',

                ]
        );
        
        	 $check = DB::connection('mysql_sec')->table('society')
    	            ->where('society_id',$society_id)
    	            ->first();
        
    	 $insert = DB::connection('mysql_sec')->table('society')
    	            ->where('society_id',$society_id)
                    ->update([
                        'society_name'=>$society,
                        'city_id'=>$city,
                        ]);
     
     
        if($insert){
           DB::connection('mysql_sec')->table('address')
            ->where('society',$check->society_name)
            ->update(['society'=>$society]);
            return redirect()->back()->withSuccess('Updated Successfully.');
        }else{
             return redirect()->back()->withErrors('Something went Wrong.');
        }
    }
    
    public function societydelete(Request $request)
    {
        
                    $society_id=$request->society_id;
            
                    $city= DB::connection('mysql_sec')->table('society')
                            ->where('society_id',$society_id)
                            ->first();
            
                	$delete=DB::connection('mysql_sec')->table('society')->where('society_id',$request->society_id)->delete();
                    if($delete)
                    {
                      DB::connection('mysql_sec')->table('address')
                        ->where('society',$city->society_name)
                        ->delete();
                    return redirect()->back()->withSuccess('Deleted successfully');
            
                    }
                    else
                    {
                       return redirect()->back()->withErrors('Something Wents Wrong'); 
                    }
    }
}