<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class HomeDesignController extends Controller
{


  public function homeDesign(){
    
    $title = "Product List";
    $admin_email=Session::get('bamaAdmin');
    $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
    $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
    $sectionTypes= DB::connection('mysql_sec')->table('home_sections_types')->get();
    $totalSectionTypes= count($sectionTypes);
    //$store = DB::connection('mysql_sec')->table('store')->where('email', $admin_email)->first();
    $designs= DB::connection('mysql_sec')->table('home_design_section')->where('store_id',0)->get();

    if( count($designs) >0 ){
      foreach ($designs as $key => $value) {
        
        //$value->name = DB::connection('mysql_sec')->table('home_sections_types')->where('id',$value->name)->pluck('name')->first();
        $rows = DB::connection('mysql_sec')->table('home_content')->where(['section_id'=>$value->id])->get();
        $value->totalRow = count($rows);
          if($value->section_type == 1){
            $value->section_type_name = "Categorie";
          }elseif ($value->section_type == 2) {
            $value->section_type_name = "Sub-Categorie";
          }elseif ($value->section_type == 3) {
            $value->section_type_name = "Product";
          }
      }
    }
    return view('protocol.admin.home_design.index', compact("title","sectionTypes","totalSectionTypes","admin","logo","designs"));
  }

  public function createSection(Request $request){
    //echo"<pre>";print_r($request->all());die;
  	if($request->hasFile('image')){
      $image = $this->uploadImage($request->image,'home_design');
    }else{
       $image='';
    }
  	$insert = DB::connection('mysql_sec')->table('home_design_section')
              ->insertgetid([
                  'name'=>$request->name,
                  'image'=>$image,
                  'is_banner'=>$request->is_banner,
                  'section_type'=>$request->section_type
                  ]);

    $layout = array(
      'home_section_id'=>$insert,
      'section_type'=>$request->section_type,
      'view_type'=>'grid',
    );

    if($request->section_type == 1 ||$request->section_type ==2){
      $layout['app_layout_design'] = 2;
    }else{
      $layout['app_layout_design'] = 1;
    }

     DB::connection('mysql_sec')->table('home_layouts')->insert($layout);
    $url = route("edit.section",$insert);
    return $url;
  }
 
  public function checkVailidCate(){
    $result =array();
    $cates = DB::connection('mysql_sec')->table('product')->get();
    foreach ($cates as $cate) {
      $result['categories'][]=$cate->parent_cat_id;
      $result['subcategories'][]=$cate->cat_id;
    }
    $result['categories'] = array_unique($result['categories']);
    $result['subcategories'] = array_unique($result['subcategories']);
    return $result;
  }

  public function editSection(Request $request){
      
      $id = $request->id;
      $confirmed = array();
      $parentCatIds = array();
      $confirmedEntries = array();
      $title = "Edit Section";
      $admin_email=Session::get('bamaAdmin');
      $admin= DB::table('admin')->where('admin_email',$admin_email)->first();
      $logo = DB::table('tbl_web_setting')->where('set_id', '1')->first();

      $city = DB::table('city')->get();

      $section = DB::connection('mysql_sec')->table('home_design_section')->where('id',$id)->first();
      $sectionContents = DB::connection('mysql_sec')->table('home_content')->where('section_id',$section->id)->get();
      $cateArr = $this->checkVailidCate();
      $parentCategory = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id', $cateArr['categories'])->get();
      //echo"<pre>";print_r($parentCategory);die;
      $categories = DB::connection('mysql_sec')->table('categories')->where('level', '!=', 0)->get();
      

      if($section->section_type == 1){
        foreach ($sectionContents as $key => $value) {
          $confirmed[] = $value->category_id;
          $confirmedEntries[] = DB::connection('mysql_sec')->table('categories')->where('cat_id',$value->category_id)->get();
        }
        return view('protocol.admin.home_design.category_add', compact('title','city','admin','logo','categories','parentCategory','section','confirmed','confirmedEntries'));

      }elseif($section->section_type == 2){
        foreach ($sectionContents as $key => $value) {
          $confirmed[] = $value->sub_category;
          $confirmedEntries[] = DB::connection('mysql_sec')->table('categories')->where('cat_id',$value->sub_category)->get();
        }
        $parentCategories = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id',$confirmed)->pluck('parent');
        foreach ($parentCategories as $key => $value) {
          $parentCatIds[] = $value;
        }
        return view('protocol.admin.home_design.sub_category_add', compact('title','city','admin','logo','categories','parentCategory','section','confirmed','parentCatIds','confirmedEntries'));

      }elseif($section->section_type == 3){
        foreach ($sectionContents as $key => $value) {
          $confirmed[] = $value->product_id;
          $confirmedEntries[] = DB::connection('mysql_sec')->table('product')->where('product_id',$value->product_id)->get();
        }
        
        return view('protocol.admin.home_design.product_add', compact('title','city','admin','logo','categories','parentCategory','section','confirmed','confirmedEntries'));
      }

  }

  public function deletehomeDesign(Request $request){
    $id = $request->id;
    $findAny = DB::connection('mysql_sec')->table('home_design_section')->where('id',$id)->delete();
     DB::connection('mysql_sec')->table('home_layouts')->where('home_section_id',$id)->delete();
    return 1;
  }

  public function getCategoryProduct(Request $request){
    
    $catId    = $request->cat;
    $subCatId = $request->subCat;

    if(is_array($subCatId)){      
        $products = DB::connection('mysql_sec')->table('product')->where('parent_cat_id',$catId)->whereIn('cat_id',$subCatId)->get();
    }else{
        $products = DB::connection('mysql_sec')->table('product')->where('parent_cat_id',$catId)->where('cat_id',$subCatId)->get();
    }

    foreach ($products as $key => $value) {
      $value->product_image = url('')."/".$value->product_image;
    }

    $response = array();

    if( count($products)>0 ){
      $response['status'] = 200;
      $response['data']   = $products;
    }else{
      $response['status'] = 404;
      $response['data']   = array();
    }

    return $response;
    
  }


  public function updateSection(Request $request){

    $section_id = $request->section_id;
    $section_name = $request->section_name;

    if(isset($request->category)){
      if(count($request->category) > 0){
          
          foreach ($request->category as $key => $row) {
                
                $findAny = DB::connection('mysql_sec')->table('home_content')->where('category_id',$row)->where('section_id',$section_id)->first();
                if(!$findAny){
                  DB::connection('mysql_sec')->table('home_content')->insertgetid(['category_id'=>$row,'section_id'=>$section_id]);
                }

          }

      }
    }

    $this->validate($request,['section_name'=>'required',],['section_name.required'=>'section Name Required',]);
    
    $sec = DB::connection('mysql_sec')->table('home_design_section')->where('id',$section_id)->first();
    if($request->hasFile('image')){
      $image = $this->uploadImage($request->image,'home_design');
    }else{
      $image = $sec->image;
    }
    $data = array( "name" => $section_name,'image'=>$image);
    $res = DB::connection('mysql_sec')->table('home_design_section')->where('id',$section_id)->update($data);

    return redirect()->back()->withSuccess('Updated Successfully');

  }

  public function saveContentToSection( Request $request ){
    
    $product_id   = $request->product_id;
    $section_id   = $request->section_id;
    $section_type = $request->section_type;
    $findAny      = array();
    $response     = array();

    $findAny = DB::connection('mysql_sec')->table('home_content')->where('product_id',$product_id)->where('section_id',$section_id)->first();

    if($findAny){

      $findAny = DB::connection('mysql_sec')->table('home_content')->where('product_id',$product_id)->where('section_id',$section_id)->delete();
      $response['status'] = 200;
      $response['data']   = 'success';

    }else{

      if(empty($findAny)){

          $data = array(
              'section_id'  => $section_id,
              'category_id' => '',
              'sub_category'=> '',
              'product_id'  => $product_id,
              'status'      => 1,
          );

        $findAny = DB::connection('mysql_sec')->table('home_content')->insertgetid($data);
        $response['status'] = 200;
        $response['data']   = 'success';

      }

    }
    
    return $response;

  }



  public function getSubCategory(Request $request){

    $category_id = $request->cat;
    $categories = DB::connection('mysql_sec')->table('categories')->where('level',1)->where('parent',$category_id)->get();
    foreach ($categories as $key => $value) {
      $value->image = url('')."/".$value->image;
    }
    $response = array();

    $response['status'] = 200;
    $response['data'] = $categories;

    return $response;

  }

  public function getSubCategories(Request $request){
    $category_id=array();
    if(isset($request->cat)){
      $category_id = $request->cat;
    }
    $filter = $request->all();
    $data = $this->getValidCategory($filter);
    $storeDetail = $this->storeDetail();

    $storeId = $storeDetail->store_id;
    $storeVarientId =array();
    $storeProductsId =array();
    $catIds =array();

    $storeVarientId = DB::connection('mysql_sec')->table('store_products')->where('store_id',$storeId)->pluck('varient_id')->toArray();

    if( count($storeVarientId) >0 ){
      $storeProductsId = DB::connection('mysql_sec')->table('product_varient')->whereIn('varient_id',$storeVarientId)->pluck('product_id')->toArray();
    }

    if( count($storeProductsId) >0 ){
      $catIds = DB::connection('mysql_sec')->table('product')->whereIn('product_id',$storeProductsId)->pluck('cat_id')->toArray();
    }


    $categories = DB::connection('mysql_sec')->table('categories')
    ->WhereIn('cat_id',$catIds)->WhereIn('parent',$category_id)->get();

    // if(isset($request->discount_type) && isset($request->discount_amount) && $request->discount_type !='None'){
      
    //   //echo"<pre>";print_r($data);die;
    //   $categories = DB::connection('mysql_sec')->table('categories')->where('level',1)->whereIn('cat_id',$data['childCat'])->WhereIn('parent',$category_id)->get();
    // }else{
    //   $categories = DB::connection('mysql_sec')->table('categories')->where('level',1)->WhereIn('parent',$category_id)->get();
    // }
    if(count($categories) >0){
      foreach ($categories as $key => $value) {
        $value->image = url('')."/".$value->image;
      }
    }

    $response = array();

    $response['status'] = 200;
    $response['data'] = $categories;

    return $response;

  }

  // public function getSubCategories(Request $request){

  //   $category_id = $request->cat;
  //   $categories = DB::connection('mysql_sec')->table('categories')->where('level',1)->WhereIn('parent',$category_id)->get();
  //   if(count($categories) > 0){
  //     foreach ($categories as $key => $value) {
  //       $value->image = url('')."/".$value->image;
  //     }
  //   }
  //   $response = array();

  //   $response['status'] = 200;
  //   $response['data'] = $categories;

  //   return $response;

  // }


  public function saveSubcategoryContent(Request $request){
    
    $section_id = $request->section_id;
    $subCategoryId = $request->product_id;
    $section_type = $request->section_type;

    $findAny      = array();
    $response     = array();


    $findAny = DB::connection('mysql_sec')->table('home_content')->where('sub_category',$subCategoryId)->where('section_id',$section_id)->first();

        if($findAny){

            $findAny = DB::connection('mysql_sec')->table('home_content')->where('sub_category',$subCategoryId)->where('section_id',$section_id)->delete();
            $response['status'] = 200;
            $response['data']   = 'success';

          }else{

            if(empty($findAny)){

                $data = array(
                    'section_id'  => $section_id,
                    'category_id' => '',
                    'sub_category'=> $subCategoryId,
                    'product_id'  => '',
                    'status'      => 1,
                );

              $findAny = DB::connection('mysql_sec')->table('home_content')->insertgetid($data);
              $response['status'] = 200;
              $response['data']   = 'success';

            }

          }

          return $response;

  }



  public function saveCategoryContent(Request $request){

      $CategoryId = $request->product_id;
      $section_id = $request->section_id;
      $section_type = $request->section_type;

      $findAny      = array();
      $response     = array();

      $findAny = DB::connection('mysql_sec')->table('home_content')->where('category_id',$CategoryId)->where('section_id',$section_id)->first();


      if($findAny){

            $findAny = DB::connection('mysql_sec')->table('home_content')->where('category_id',$CategoryId)->where('section_id',$section_id)->delete();

          }else{

            if(empty($findAny)){

                $data = array(
                    'section_id'  => $section_id,
                    'category_id' => $CategoryId,
                    'sub_category'=> '',
                    'product_id'  => '',
                    'status'      => 1,
                );

              $findAny = DB::connection('mysql_sec')->table('home_content')->insertgetid($data);
              
            }

          }

          $response['status'] = 200;
          $response['data']   = 'success';

          return $response;

  }


  public function toggleSectionStatus($id=null){

    $status = 0;
    $check_is_status = DB::connection('mysql_sec')->table('home_design_section')->where('id',$id)->pluck('is_active')->first();

    if($check_is_status == 1){
      $status = 0;
    }else if($check_is_status == 0){
      $status = 1;
    }

    DB::connection('mysql_sec')->table('home_design_section')->where('id',$id)->update(['is_active'=>$status]);
    return redirect()->route('homeDesign');
  }
}
