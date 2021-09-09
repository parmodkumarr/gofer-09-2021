<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class HomeLayoutController extends Controller{


    public function homeLayoutList(){

        $title = "Home Layout List";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
        
        $homeLayouts= DB::connection('mysql_sec')->table('home_layouts')->get();
        
        return view('protocol.admin.home_layout.home_layout_list', compact("title","admin_email","admin","logo","homeLayouts"));
    }

    // public function homeLayoutFormView(){

    //     $title = "Add Layout";
    //     $admin_email=Session::get('bamaAdmin');
    //     $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
    //     $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
    //     $sectionTypes = DB::connection('mysql_sec')->table('home_sections_types')->get();

    //     return view('protocol.admin.home_layout.home_layout_add', compact('title','admin','logo','admin_email','sectionTypes'));
    // }
    public function homeLayoutFormView(Request $request){

        $layout_id = "";
        $app_layout_design = "";
        $store_id = NULL;
        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();

        if($store){
            $store_id =$store->store_id;
        }
        $section_id = $request->section_id;
        $sectionDetail = DB::connection('mysql_sec')->table('home_design_section')->where('id',$section_id)->first();

        $ifAvailableLayout = DB::connection('mysql_sec')->table('home_layouts')->where(['home_section_id'=>$section_id,'store_id'=>$store_id])->first();
        
        if($ifAvailableLayout){
            $layout_id = $ifAvailableLayout->layout_id;
            $app_layout_design = $ifAvailableLayout->app_layout_design;
        }else{
            $layout_id = "";
            $app_layout_design = "";
        }

        $title = "Add Layout";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
        $sectionTypes = DB::connection('mysql_sec')->table('home_sections_types')->get();
        $sectionTypeDetail = DB::connection('mysql_sec')->table('home_sections_types')->where('id',$sectionDetail->section_type)->first();

        $appLayoutTypes = DB::connection('mysql_sec')->table('app_layout_view')->where('section_type',$sectionDetail->section_type)->get();
        
        if($sectionDetail->section_type == 1){

            return view('protocol.admin.home_design.home_layout.home_layout_for_category', compact('title','admin','logo','admin_email','sectionTypes','section_id','sectionDetail','store','layout_id','sectionTypeDetail','appLayoutTypes','ifAvailableLayout'));

        }elseif($sectionDetail->section_type == 2){

            return view('protocol.admin.home_design.home_layout.home_layout_for_sub_category', compact('title','admin','logo','admin_email','sectionTypes','section_id','sectionDetail','store','layout_id','appLayoutTypes','ifAvailableLayout'));

        }elseif($sectionDetail->section_type == 3){

            return view('protocol.admin.home_design.home_layout.home_layout_for_product', compact('title','admin','logo','admin_email','sectionTypes','section_id','sectionDetail','store','layout_id','appLayoutTypes','ifAvailableLayout'));
        }
    }

    public function homeLayoutFormAddCategory(Request $request){
        
        $view_type = $request->view_type;
        // $is_background = $request->is_background;
        // $background_type = $request->background_type;
        $color = $request->color;
        $store_id = $request->store_id;
        $home_section_id = $request->home_section_id;
        $section_type = $request->section_type;
        $id = $request->id;
        $app_layout_design = $request->app_layout_design;
        $image = "";

        $this->validate(
            $request,
                [
                    'section_type'=>'required',
                    'app_layout_design' => 'required',
                ],
                [
                    'section_type.required'=>'Select Section Type',
                    'app_layout_design.required' => 'Select App Layout Design.',
                ]
        );

        if($request->hasFile('image')){
            $date = date("Y-m-d");
            $product_image = $request->image;
            $fileName = $product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('images/layout/'.$date.'/', $fileName);
            $image = 'images/layout/'.$date.'/'.$fileName;
        }

        $data = array(
                "view_type"         => $request->view_type,
                // "is_background"     => $request->is_background,
                // "background_type"   => $request->background_type,
                "color"             => $request->color,
                "store_id"          => $request->store_id,
                "home_section_id"   => $request->home_section_id,
                "app_layout_design"   => $request->app_layout_design,
                "section_type"      => $request->section_type,
                "image"             => $image,
        );
        if(isset($id) && !empty($id) ){
            $status = DB::connection('mysql_sec')->table('home_layouts')->where('layout_id',$id)->update($data);
            return redirect()->back()->withSuccess('Layout Updated Successfully');

        }else{
            $status = DB::connection('mysql_sec')->table('home_layouts')->insert($data);
            return redirect()->back()->withSuccess('Layout Added Successfully');
        }

    }
  

}
