<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class StoreOwnerController extends Controller{
    
	public function storeOwnerList(Request $request){
        $storeOwner = DB::connection('mysql_sec')->table('store_owner')->paginate(10);
        if($request->ajax()){
           return view('protocol.admin.store_owner.pagination_data_owner',compact('storeOwner'))->render();
        }
        $title = "Home";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
              
       return view('protocol.admin.store_owner.storeclist', compact('title','storeOwner','admin','logo'));    
       
    }

    public function storeOwner(Request $request){
       
       $title = "Home";
       $admin_email=Session::get('bamaAdmin');
       $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
       $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();

       $city = DB::connection('mysql_sec')->table('city')->get();
       $map1 = DB::connection('mysql_sec')->table('map_api')->first();
       $map = $map1->map_api_key;     
       $mapset = DB::connection('mysql_sec')->table('map_settings')->first();
       $mapbox = DB::connection('mysql_sec')->table('mapbox')->first();

       return view('protocol.admin.store_owner.storeadd', compact('title','city','admin','logo','map','mapset','mapbox'));    

    }



    public function storeOwnerAdded(Request $request){
       
        $title = "Home"; 
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        
       if( isset($email) ){
              $isAny = DB::connection('mysql_sec')->table('store_owner')->where('email',$email)->first();
        }else{
              $isAny = null;
        }
       
       if($isAny){
             return redirect()->back()->withErrors('This Email Are Already Registered With Another Store Owner Detail');
       }

       $this->validate(
            $request,
                [
                    'name'=>'required',
                    'email'=>'required',
                    'password'=>'required',
                    
                ],
                [   
                    'name.required'=>'Store Owner Name Required',
                    'email.required'=>'E-mail Address Required',
                    'password.required'=>'Password Required',
                ]
        );
        $data = array(
                 'name'=>$name,
                 'email'=>$email,
                 'password'=>$password,
                 );
       $insert = DB::connection('mysql_sec')->table('store_owner')->insertgetid($data);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }

    }



       public function storeOwnerEdit(Request $request){

              $title = "Edit Owner Store";
              $admin_email=Session::get('bamaAdmin');
              $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
              $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();

              $store_id = $request->store_id;

              $storeOwner = DB::connection('mysql_sec')->table('store_owner')->where('id',$store_id)->first();

        return view('protocol.admin.store_owner.storeedit', compact('title','storeOwner','admin','logo'));    
        
    }



       public function storeOwnerUpdate(Request $request){

        $title = "Home"; 
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $storeOwnerId = $request->id;
        
       if( isset($email) ){
              $isAny = DB::connection('mysql_sec')->table('store_owner')->where('email',$email)->where('id','!=',$storeOwnerId)->first();
       }
       if($isAny){
             return redirect()->back()->withErrors('This Email Are Already Registered With Another Store Owner Detail');
       }

       $this->validate(
            $request,
                [
                    'name'=>'required',
                    'email'=>'required',
                    'password'=>'required',
                    
                ],
                [   
                    'name.required'=>'Store Owner Name Required',
                    'email.required'=>'E-mail Address Required',
                    'password.required'=>'Password Required',
                ]
        );
        $data = array(
                 'name'=>$name,
                 'email'=>$email,
                 'password'=>$password,
                 );

       $insert = DB::connection('mysql_sec')->table('store_owner')->where('id',$storeOwnerId)->update($data);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }


       }


    public function storeOwnerStoreList(Request $request){

        $title = "Home";
        $ownerId = $request->owner_id;

        $city = DB::connection('mysql_sec')->table('store')->where('owner_id',$ownerId)->paginate(10);
        if($request->ajax()){
               return view('protocol.admin.store_owner.pagination_data_store',compact('city'))->render();
        }


        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
              
        return view('protocol.admin.store_owner.ownerstorelist', compact('title','city','admin','logo','ownerId'));  
       
    }



}