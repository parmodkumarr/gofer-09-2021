<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
class CityController extends Controller
{
    public function citylist(Request $request)
    {
        $city = DB::connection('mysql_sec')->table('city')
           ->paginate(10);
        if($request->ajax()){
           return view('protocol.admin.city.pagination_data',compact('city'))->render();
        }        
         $title = "City List";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
                
        return view('protocol.admin.city.citylist', compact('title','city','admin','logo'));    
        
        
    }
    public function city(Request $request)
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
                
        return view('protocol.admin.city.cityadd', compact('title','city','admin','logo'));    
        
        
    }
    public function cityadd(Request $request)
    {
        $title = "Home";
        
        $city = $request->city;
        $cities = ucfirst($city);
        
        $this->validate(
            $request,
                [
                    
                    'city'=>'required',
                ],
                [
                    
                    'city.required'=>'City Name Required',

                ]
        );
        
    	 $insert = DB::connection('mysql_sec')->table('city')
                    ->insert([
                        'city_name'=>$cities,
                        ]);
     
    return redirect()->back()->withSuccess('City Added Successfully');

    }
    
    public function cityedit(Request $request)
    {
       $title = "Update City";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        $city_id = $request->city_id;
        
        $city = DB::connection('mysql_sec')->table('city')
                ->where('city_id',$city_id)
                ->first();
                
        return view('protocol.admin.city.cityedit', compact('title','city','admin','logo'));    
        
        
    }
    
    public function cityupdate(Request $request)
    {
        $title = "Update City";
        $city_id = $request->city_id;
        $city = $request->city;
        $cities = ucfirst($city);
        $this->validate(
            $request,
                [
                    
                    'city'=>'required',
                ],
                [
                    
                    'city.required'=>'City Name Required',

                ]
        );
        
        
        $check = DB::connection('mysql_sec')->table('city')
    	       ->where('city_id',$city_id)
    	       ->first();
        
    	 $insert = DB::connection('mysql_sec')->table('city')
    	            ->where('city_id',$city_id)
                    ->update([
                        'city_name'=>$cities,
                        ]);
                        
                        
        if ($insert){               
        DB::connection('mysql_sec')->table('store')
        ->where('city',$check->city_name)
        ->update(['city'=>$cities]);
        
         DB::connection('mysql_sec')->table('delivery_boy')
         ->where('boy_city',$check->city_name)
        ->update(['boy_city'=>$cities]);
        
        DB::connection('mysql_sec')->table('address')
         ->where('city',$check->city_name)
        ->update(['city'=>$cities]);
        
        return redirect()->back()->withSuccess('City Updated Successfully');
        }else{
          return redirect()->back()->withErrors('Something Wents Wrong');  
        }
    }
    
    public function citydelete(Request $request)
    {
        
                    $city_id=$request->city_id;
            
                    $city= DB::connection('mysql_sec')->table('city')
                            ->where('city_id',$city_id)
                            ->first();
            
                	$delete=DB::connection('mysql_sec')->table('city')->where('city_id',$request->city_id)->delete();
                	
                    if($delete)
                    {
                     DB::connection('mysql_sec')->table('store')
                    ->where('city',$city->city_name)
                    ->delete();
                    
                     DB::connection('mysql_sec')->table('delivery_boy')
                     ->where('boy_city',$city->city_name)
                    ->delete();
                    
                      DB::connection('mysql_sec')->table('address')
                     ->where('city',$city->city_name)
                    ->delete();
                    
                     DB::connection('mysql_sec')->table('society')->where('city_id',$request->city_id)->delete();
                    return redirect()->back()->withSuccess('Delete successfully');
            
                    }
                    else
                    {
                       return redirect()->back()->withErrors('Something Wents Wrong'); 
                    }
    }
}