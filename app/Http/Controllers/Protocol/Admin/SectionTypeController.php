<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class SectionTypeController extends Controller{


	public function sectionTypeList(){

		$title = "Section Types List";
	    $admin_email=Session::get('bamaAdmin');
	    $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
	    $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
	    
	    $sectionTypes= DB::connection('mysql_sec')->table('home_sections_types')->get();
	    
	    return view('protocol.admin.home_design.section_type_list', compact("title","admin_email","admin","logo","sectionTypes"));
	}

	public function sectionTypeCreate(){
		
		$title = "Edit Section Type";
		$admin_email=Session::get('bamaAdmin');
		$admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
		$logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();

		return view('protocol.admin.home_design.section_type_add', compact('title','admin','logo','admin_email'));

	}



	public function sectionTypeCraeted(Request $request){

        $title = "Home"; 
        $name = $request->name;
        $is_active = $request->is_active;
        
       if( isset($name) ){
              $isAny = DB::connection('mysql_sec')->table('home_sections_types')->where('name',$name)->first();
        }else{
              $isAny = null;
        }
       if($isAny){
             return redirect()->back()->withErrors('This Section Name Is Already Registered With Another Store Owner Detail');
       }
       $this->validate(
            $request,
                [
                    'name'=>'required',
                    'is_active'=>'required',
                ],
                [   
                    'name.required'=>'Section Type Name Required',
                    'is_active.required'=>'Is active status `Required',
                ]
        );
        $data = array(
                 'name'=>$name,
                 'is_active'=>$is_active,
                 );

       $insert = DB::connection('mysql_sec')->table('home_sections_types')->insertgetid($data);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }
	}


	public function sectionTypeEdit(Request $request){
		
		$title = "Edit Section Store";
		$admin_email=Session::get('bamaAdmin');
		$admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
		$logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();

		$sectionId = $request->section_id;
		$sectionTypeDetail = DB::connection('mysql_sec')->table('home_sections_types')->where('id',$sectionId)->first();

        return view('protocol.admin.home_design.section_type_edit', compact('title','sectionTypeDetail','admin','logo'));    
	}


	public function sectionTypeUpdate(Request $request){

		$title = "Update Section Store"; 
		$name = $request->name;
		$is_active = $request->is_active;
		$id = $request->id;
		
       if( isset($name) ){
              $isAny = DB::connection('mysql_sec')->table('home_sections_types')->where('name',$name)->where('id','!=',$id)->first();
        }else{
              $isAny = null;
        }
       if($isAny){
       	dd($isAny);
             return redirect()->back()->withErrors('This Section Name Is Already Registered With Another Store Owner Detail');
       }

       $this->validate(
            $request,
                [
                    'name'=>'required',
                    'is_active'=>'required',
                ],
                [   
                    'name.required'=>'Section Type Name Required',
                    'is_active.required'=>'Is active status `Required',
                ]
        );
        $data = array(
                 'name'=>$name,
                 'is_active'=>$is_active,
                 );

       $insert = DB::connection('mysql_sec')->table('home_sections_types')->where('id',$id)->update($data);
                        
      if($insert){
        return redirect()->back()->withSuccess('Updated Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }
	}

  
}
