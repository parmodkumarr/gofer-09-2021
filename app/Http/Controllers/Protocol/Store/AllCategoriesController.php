<?php

namespace App\Http\Controllers\Protocol\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AllCategoriesController extends Controller{

    public function list(Request $request){

        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();
        $store_id = $store->store_id;
        $title = "All Categories Section List";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first(); 
        $all_categories = DB::connection('mysql_sec')->table('all_categories')->where('store_id',$store_id)->get();
            
        if(count($all_categories)>0){
            foreach($all_categories as $index => $category){
                $category->categories = DB::connection('mysql_sec')->table('categories_cat_id')->where('section_id',$category->id)->get();
            }
        }

        return view('protocol.store.all_categories.list', compact('title',"admin", "logo","all_categories","store"));
    }

    
    public function addCategoriesSection(Request $request){

        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();

        $title = "Add Categories Section";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
        $cat = DB::connection('mysql_sec')->table('categories')->select('parent')->get();
           
        if(count($cat)>0){
            foreach($cat as $cats) {
                $a = $cats->parent;
               $aa[] = array($a);
            }
        }else{
            $a = 0;
            $aa[] = array($a);
        }

        $category = DB::table('categories')->where('level', '!=', 0)->WhereNotIn('cat_id',$aa)->get();
        $parentCategory = DB::table('categories')->where('level', '==', 0)->where('parent', '==', 0)->get();
        $confirmed = array();

        return view('protocol.store.all_categories.add',compact("category","parentCategory","admin_email","logo", "admin","title","store","confirmed"));
    }
    
    public function submitCategoriesSection(Request $request){

        dd($request->all());
        $title = $request->title;
        $description = $request->description;
        $discount_type = $request->discount_type;
        $discount_amount = $request->discount_amount;
        $date=date('d-m-Y');
        $category_ids=$request->categoryIds;

        $this->validate(
            $request,
                [
                    'title'=>'required',
                    'description' => 'required',
                    'discount_type' => 'required',
                    'discount_amount'=> 'required',
                ],
                [
                    'title.required'=>'Select Title',
                    'description.required' => 'Enter Description.',
                    'discount_type.required' => 'Choose Discount Type.',
                    'discount_amount.required' => 'Enter Discount Amount.'
                ]
        );
        if($request->hasFile('image')){
            $product_image = $request->image;
            $fileName = $product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('images/category_section_images/'.$date.'/', $fileName);
            $image = 'images/category_section_images/'.$date.'/'.$fileName;
        }
        else{
            $image = "";
        }
        
        $data = array(
                    'title'=>$title,
                    'description'=>$description,
                    'discount_type'=>$discount_type,
                    'discount_amount'=>$discount_amount,
                );
        if(!empty($image)){
            $data['image'] = $image;
        }
        $insertproduct = DB::connection('mysql_sec')->table('all_categories')->insertGetId($data);
        
        if($insertproduct){
            if(count($category_ids)>0){
                $section_id = $insertproduct;
                foreach( $category_ids as $index => $category_id ){
                    DB::connection('mysql_sec')->table('categories_cat_id')
                            ->insert([
                                'section_id'=>$section_id,
                                'cat_id'=>$category_id,
                                'status'=>1,
                            ]);
                }
            }
            return redirect()->back()->withSuccess('Product Added Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
      
    }

    public function submitCategoriesSectionNew(Request $request){
        $title = $request->title;
        $description = $request->description;
        $date=date('d-m-Y');
        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();

        $this->validate(
            $request,
                [
                    'title'=>'required',
                    'description' => 'required',
                ],
                [
                    'title.required'=>'Select Title',
                    'description.required' => 'Enter Description.',
                ]
        );
        if($request->hasFile('image')){
            $product_image = $request->image;
            $fileName = $product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('images/category_section_images/'.$date.'/', $fileName);
            $image = 'images/category_section_images/'.$date.'/'.$fileName;
        }
        else{
            $image = "";
        }
        
        $data = array(
                    'title'=>$title,
                    'description'=>$description,
                    'store_id'=>$store->store_id
                );
        if(!empty($image)){
            $data['image'] = $image;
        }
        $insertproduct = DB::connection('mysql_sec')->table('all_categories')->insertGetId($data);
        
        if($insertproduct){
            return redirect()->route('edit.categories.section',$insertproduct);
            //return redirect()->back()->withSuccess('Product Added Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
      
    }



    public function fetchDiscountedCategories(Request $request){
        
        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();

        $discount_amount= $request->discount_amount;
        $discount_type  = $request->discount_type;
        //$discount_type  = "Flat";
        $store_id       = $store->store_id;

        // $sub_cat_ids =  DB::connection('mysql_sec')->table('store_products')
        //             ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
        //             ->join('product', 'product_varient.product_id', '=', 'product.product_id')
        //             ->where('store_products.store_id', $store_id)
        //             // ->select('product.cat_id as sub_cat')
        //             ->select('store_products.*')
        //             ->where('store_products.discount_type','=',$discount_type)
        //             ->groupBy('product.cat_id')
        //             ->get();

        $sub_cat_ids =  DB::connection('mysql_sec')->table('store_products')
                        ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                        ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                        ->join('categories', 'categories.cat_id', '=', 'product.cat_id')
                        ->where('store_products.store_id', $store_id)
                        // ->select('product.cat_id as sub_cat')
                        ->select('categories.parent')
                        ->where('store_products.total_discount','<=',$discount_amount)
                        ->where('store_products.store_discount_type','=',$discount_type)
                        ->groupBy('categories.parent')
                        ->get();
                        
        if( !empty($sub_cat_ids) ){
            $ids = array();
            foreach( $sub_cat_ids as $index => $sub_cat ){
                $ids[] = $sub_cat->parent;
            }

        }        

        $all_categories = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id',$ids)->get();
        foreach($all_categories as $row){
            $row->image = url('')."/".$row->image;
        }
        $result = array();
        $result['status'] = 200;
        $result['data'] = $all_categories;

        return $result;


    }


    
    public function editCategoriesSection(Request $request){

        $section_id = $request->section_id;
        
        $title = "Edit Categories Section";
        $admin_email=Session::get('bamaAdmin');

        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();


        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
        
        $cat = DB::connection('mysql_sec')->table('categories')->select('parent')->get();   
        if(count($cat)>0){
            foreach($cat as $cats) {
                $a = $cats->parent;
               $aa[] = array($a);
            }
        }else{
            $a = 0;
            $aa[] = array($a);
        } 

        $category = DB::table('categories')->where('level', '!=', 0)->WhereNotIn('cat_id',$aa)->get();
        $parentCategory = DB::table('categories')->where('level', '==', 0)->where('parent', '==', 0)->get();

        $category_section_detail = DB::connection('mysql_sec')->table('all_categories')->where('id',$section_id)->first();
        $sectionContents = DB::connection('mysql_sec')->table('categories_cat_id')->where('section_id',$section_id)->get();
       //echo"<pre>";print_r($sectionContents);die;
        $confirmed =array();
        $confirmedEntries =array();
        foreach($sectionContents as $key => $value) {
          $confirmed[] = $value->cat_id;
          $confirmedEntries[] = DB::connection('mysql_sec')->table('categories')->where('cat_id',$value->cat_id)->get();
        }
        // dd($category_section_detail);
        return view('protocol.store.all_categories.edit',compact("admin_email","admin","logo","title","category_section_detail","parentCategory","category","confirmed","store","confirmedEntries"));
    }

    public function updateCategoriesSection(Request $request)
    {
        $title = $request->title;
        $id = $request->section_id;
        $description = $request->description;
        $discount_type = $request->discount_type;
        $discount_amount = $request->discount_amount;
        $date=date('d-m-Y');
        $email=Session::get('bamaStore');
        $store= DB::connection('mysql_sec')->table('store')->where('email',$email)->first();

        $this->validate(
            $request,
                [
                    'title'=>'required',
                    'description' => 'required',
                    'discount_type' => 'required',
                    'discount_amount' => 'required',
                ],
                [
                    'title.required'=>'Select Title',
                    'description.required' => 'Enter Description.',
                    'discount_type.required' => 'Select Discount Type.',
                    'discount_amount.required' => 'Enter Discount Amount.',
                ]
        );
        if($request->hasFile('image')){
            $product_image = $request->image;
            $fileName = $product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('images/category_section_images/'.$date.'/', $fileName);
            $image = 'images/category_section_images/'.$date.'/'.$fileName;
        }
        else{
            $image = "";
        }
        
        $data = array(
                    'title'=>$title,
                    'description'=>$description,
                    'store_id'=>$store->store_id,
                    'discount_type'=>$discount_type,
                    'discount_amount'=>$discount_amount,
                );
        if(!empty($image)){
            $data['image'] = $image;
        }
        $insertproduct = DB::connection('mysql_sec')->table('all_categories')->where('id',$id)->update($data);
        
        if($insertproduct){
            //return redirect()->route('edit.categories.section',$insertproduct);
            return redirect()->back()->withSuccess('Product Update Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
      

    }     
    public function DeleteProduct(Request $request)
    {
        $product_id=$request->product_id;

        $delete=DB::connection('mysql_sec')->table('product')->where('product_id',$request->product_id)->delete();
        if($delete)
        {
         $delete=DB::connection('mysql_sec')->table('product_varient')->where('product_id',$request->product_id)->delete();  
         
        return redirect()->back()->withSuccess('Deleted Successfully');
        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }
    }


    public function saveAllCategoryContent(Request $request){

      $CategoryId = $request->cat_id;
      $section_id = $request->section_id;

      $findAny      = array();
      $response     = array();

      $findAny = DB::connection('mysql_sec')->table('categories_cat_id')->where('cat_id',$CategoryId)->where('section_id',$section_id)->first();


      if($findAny){

            $findAny = DB::connection('mysql_sec')->table('categories_cat_id')->where('cat_id',$CategoryId)->where('section_id',$section_id)->delete();

          }else{
            if(empty($findAny)){
                $data = array(
                    'section_id'  => $section_id,
                    'cat_id' => $CategoryId,
                    'status'      => 1,
                );
              $findAny = DB::connection('mysql_sec')->table('categories_cat_id')->insertgetid($data);
              
            }

          }

          $response['status'] = 200;
          $response['data']   = 'success';

          return $response;

  }


}