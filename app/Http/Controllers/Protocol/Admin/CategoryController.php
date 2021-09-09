<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\carbon;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        $category = DB::connection('mysql_sec')->table('categories')
                    ->leftJoin('categories as catt', 'categories.parent', '=' , 'catt.cat_id')
                    ->select('categories.*', 'catt.title as tttt')
                    ->paginate(10);
        if($request->ajax()){
           return view('protocol.admin.category.pagination_data',compact('category'))->render();
        }

        $title = "Category List";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();

        return view('protocol.admin.category.index', compact('title',"admin", "logo","category"));
    }

    public function getsubcategorylist(Request $request){
        $category = DB::connection('mysql_sec')->table('categories')->where('parent',$request->cateid)->get();
        return ['status'=>'success','data'=>$category];
    }

    public function AddCategory(Request $request)
    {
    
        $title = "Add Category";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
           $category = DB::connection('mysql_sec')->table('categories')
                    ->where('level', 0)
                    // ->orWhere('level', 1)
                    ->get();
        
        
        return view('protocol.admin.category.add',compact("category", "admin_email","logo", "admin","title"));
     }
    
     public function AddNewCategory(Request $request)
    {
        $parent_id = $request->parent_id;
        $category_name = $request->cat_name;
        $status = 1;
        $slug = str_replace(" ", '-', $category_name);
        $date=date('d-m-Y');
        $desc = $request->desc;
          
        if($desc==NULL){
          $desc= $category_name; 
        }
        $category = DB::connection('mysql_sec')->table('categories')
                  ->where('cat_id', $parent_id)
                  ->first();
    			         
        if($status=="")
        {
            $status=0;
        }
  
    if($category)
        {    
        if($parent_id==$category->cat_id)
            {
                if($category->level==0){
                    $level = 1;
                } 
                elseif($category->level==1){
                    $level = 2;
                }
            }
        }
        else{
           $level = 0; 
        }
        
     
        $this->validate(
            $request,
                [
                    
                    'cat_name' => 'required',
                    'cat_image' => 'required|mimes:jpeg,png,jpg|max:400',
                ],
                [
                    'cat_name.required' => 'Enter category name.',
                    'cat_image.required' => 'Choose category image.',
                ]
        );

        

        

        if($request->hasFile('cat_image')){
            $category_image = $request->cat_image;
            $fileName = $category_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $category_image->move('images/category/'.$date.'/', $fileName);
            $category_image = 'images/category/'.$date.'/'.$fileName;
        }
        else{
            $category_image = 'N/A';
        }

        $insertCategory = DB::connection('mysql_sec')->table('categories')
                            ->insert([
                                'parent'=>$parent_id,
                                'title'=>$category_name,
                                'slug'=>$slug,
                                'level'=>$level,
                                'image'=>$category_image,
                                'status'=>$status,
                                'description'=>$desc,
                               
                               
                            ]);
        
        if($insertCategory){
            return redirect()->back()->withSuccess('Category Added Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
      
    }
    
    public function EditCategory(Request $request)
    {
         $category_id = $request->category_id;
         $title = "Edit Category";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
          $category = DB::connection('mysql_sec')->table('categories')
                    ->where('level', 0)
                    ->orWhere('level', 1)
                    ->where('cat_id','!=',$category_id)
                    ->get();
                    
        $cat=  DB::connection('mysql_sec')->table('categories')
            ->where('cat_id', $category_id)
            ->first();

        return view('protocol.admin.category.edit',compact("category","admin_email","admin","logo","cat","title"));
    }

    public function UpdateCategory(Request $request)
    {
        $category_id = $request->category_id;
         $parent_id = $request->parent_id;
        $category_name = $request->cat_name;
        $status = 1;
        $slug = str_replace(" ", '-', $category_name);
        $date=date('d-m-Y');
          $desc = $request->desc;
        if($desc==NULL){
          $desc= $category_name; 
        }
        $category = DB::connection('mysql_sec')->table('categories')
                  ->where('cat_id', $parent_id)
                  ->first();
    			         
        if($status=="")
        {
            $status=0;
        }
  
    if($category)
        {    
        if($parent_id==$category->cat_id)
            {
                if($category->level==0){
                    $level = 1;
                } 
                elseif($category->level==1){
                    $level = 2;
                }
            }
        }
        else{
           $level = 0; 
        }
        
    
        
        $this->validate(
            $request,
                [
                    
                    'cat_name' => 'required',
                ],
                [
                    'cat_name.required' => 'Enter category name.',
                ]
        );

       $getCategory = DB::connection('mysql_sec')->table('categories')
                    ->where('cat_id',$category_id)
                    ->first();

        $image = $getCategory->image;

        if($request->hasFile('cat_image')){
            $category_image = $request->cat_image;
            $fileName = $category_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $category_image->move('images/category/'.$date.'/', $fileName);
            $category_image = 'images/category/'.$date.'/'.$fileName;
        }
        else{
            $category_image = $image;
        }

        $insertCategory = DB::connection('mysql_sec')->table('categories')
                       ->where('cat_id', $category_id)
                            ->update([
                                'parent'=>$parent_id,
                                'title'=>$category_name,
                                'slug'=>$slug,
                                'level'=>$level,
                                'image'=>$category_image,
                                'status'=>$status,
                                'description'=>$desc
                               
                            ]);
        
        if($insertCategory){
            return redirect()->back()->withSuccess('Category Added Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
       
       
       
       
    }
    
    
    
 public function DeleteCategory(Request $request)
    {
        $category_id=$request->category_id;

    	$delete=DB::connection('mysql_sec')->table('categories')->where('cat_id',$request->category_id)->delete();
        if($delete)
        {
          $deleteproduct=DB::connection('mysql_sec')->table('product')
          ->where('cat_id',$request->category_id)->delete();
          
          $deletechild=DB::connection('mysql_sec')->table('categories')
          ->where('parent',$request->category_id)->delete();  
        return redirect()->back()->withSuccess('Deleted Successfully');
        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }
    }



 
}