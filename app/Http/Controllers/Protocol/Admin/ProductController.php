<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ProductController extends Controller
{
    public function list(Request $request)
    {   
        $product = DB::connection('mysql_sec')->table('product')
                    ->leftjoin('categories','product.parent_cat_id','=','categories.cat_id')
                    ->paginate(10);

        if($request->ajax()){
           return view('protocol.admin.product.pagination_data',compact('product'))->render();
        }

        $title = "Product List";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
           
    	return view('protocol.admin.product.list', compact('title',"admin", "logo","product"));
    }
    public function SelectSubcategory(Request $request)
    {
        if(count($cat)>0){ 
            foreach($cat as $cats) {
                $a = $cats->parent;
               $aa[] = array($a); 
            }
        }
        else{
            $a = 0;
           $aa[] = array($a);
        }

        if($request->category){
            $category = DB::connection('mysql_sec')->table('categories')->where('parent', '=', $request->category)->WhereNotIn('cat_id',$aa)->get();
        }else{
            $category = DB::connection('mysql_sec')->table('categories')->WhereNotIn('cat_id',$aa)->get();
        }
        return $category;
    }
    
     public function AddProduct(Request $request)
    {
        
    // DB::connection('mysql_sec')->table('product_varient')
    //             ->where('unit', 'kg')->update(['increment_value'=>1]);
        $title = "Add Product";
         $admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
           $cat = DB::connection('mysql_sec')->table('categories')
                   ->select('parent')
                   ->get();
                   
        if(count($cat)>0){           
        foreach($cat as $cats) {
            $a = $cats->parent;
           $aa[] = array($a); 
        }
        }
        else{
            $a = 0;
           $aa[] = array($a);
        }

        $category = DB::connection('mysql_sec')->table('categories')->where('level', '!=', 0)->WhereNotIn('cat_id',$aa)->get();
        $parentCategory = DB::connection('mysql_sec')->table('categories')->where('level', '==', 0)->where('parent', '==', 0)->get();
   
        
        return view('protocol.admin.product.add',compact("category","parentCategory","admin_email","logo", "admin","title"));
     }
    
     public function AddNewProduct(Request $request)
    {//echo"<pre>";print_r($request->all());die;
        $category_id=$request->cat_id;
        $product_name = $request->product_name;
        $quantity = $request->quantity;
        $unit = $request->unit;
        $parent_cat_id = $request->parent_cat_id;
        $description = $request->description;
        $date=date('d-m-Y');
        $mrp = $request->mrp;
        $price = $request->mrp;
        $discount_type = $request->discount_type;
        $discount_amount = $request->discount_amount;
        $increment_value = $request->increment_value;
        
        
        
        $this->validate(
            $request,
                [
                    'cat_id'=>'required',
                    'product_name' => 'required',
                    'product_image' => 'required|mimes:jpeg,png,jpg|max:1000',
                    'quantity'=> 'required',
                    'unit'=> 'required',
                    //'price'=> 'required',
                    'mrp'=>'required',
                    'increment_value'=>'required',
                ],
                [
                    'cat_id.required'=>'Select category',
                    'product_name.required' => 'Enter product name.',
                    'product_image.required' => 'Choose product image.',
                    'quantity.required' => 'Enter quantity.',
                    'unit.required' => 'Choose unit.',
                    'price.required' => 'Enter price.',
                    'mrp.required'=>'Enter MRP.',
                    'increment_value.required'=>'Enter Increment Value.',
                ]
        );


        if($request->hasFile('product_image')){
            $product_image = $request->product_image;
            $fileName = $product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('images/product/'.$date.'/', $fileName);
            $product_image = 'images/product/'.$date.'/'.$fileName;
        }
        else{
            $category_image = '';
        }
        if($discount_amount == ""){
            $discount_amount = 0;
        }
        
        if($discount_type == 2){
            $price = $mrp - (($discount_amount/100)*$mrp);
        }
        if($discount_type == 1){
            $price = $mrp - $discount_amount;
        }
        

        $insertproduct = DB::connection('mysql_sec')->table('product')
                            ->insertGetId([
                                'cat_id'=>$category_id,
                                'parent_cat_id'=>$parent_cat_id,
                                'product_name'=>$product_name,
                                'product_image'=>$product_image,
                                
                               
                            ]);
        
        if($insertproduct){

            $data = array(
                    'product_id'=>$insertproduct,
                    'image'=>$product_image,
                    );
            $status = DB::connection('mysql_sec')->table('product_images')->insert($data);

            $insertvarient = DB::connection('mysql_sec')->table('product_varient')
                ->insertGetId([
                'product_id'=>$insertproduct,
                'quantity'=>$quantity,
                'varient_image'=>$product_image,
                'unit'=>$unit,
                'increment_value'=>$increment_value,
                'base_price'=>$price,
                'base_mrp'=>$mrp,
                'description'=>$description,
                'discount_type'=>$discount_type,
                'discount_amount'=>$discount_amount,
               
            ]);
            
            $insert2 = DB::connection('mysql_sec')->table('store_products')
                  ->insert(['store_id'=>0,'stock'=>$quantity, 'varient_id'=>$insertvarient, 'price'=>$price,'mrp'=>$mrp,'discount_type'=>$discount_type,'discount_amount'=>$discount_amount,'store_discount_type'=>$discount_type,'total_discount'=>$discount_amount]);

            return redirect()->back()->withSuccess('Product Added Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
      
    }
    
    public function EditProduct(Request $request){

         $product_id = $request->product_id;
         $title = "Edit Product";
         $admin_email=Session::get('bamaAdmin');
    	   $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	   $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
           $product = DB::connection('mysql_sec')->table('product')
                   ->where('product_id',$product_id)
                    ->first();
           $cat = DB::connection('mysql_sec')->table('categories')
                   ->select('parent')
                   ->get();
                   
            if(count($cat)>0){           
            foreach($cat as $cats) {
                $a = $cats->parent;
               $aa[] = array($a); 
            }
            }
            else{
                $a = 0;
               $aa[] = array($a);
            }

            $category = DB::connection('mysql_sec')->table('categories')->where('level', '!=', 0)->WhereNotIn('cat_id',$aa)->get();
            $parentCategory = DB::connection('mysql_sec')->table('categories')->where('level', '==', 0)->where('parent', '==', 0)->get();         

        return view('protocol.admin.product.edit',compact("admin_email","admin","logo","title","product","category","parentCategory"));
    }

    public function addInfoHighLight(Request $request){
        $product_id = $request->product_id;
        $title = "Edit Info Highlight";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
        $product = DB::connection('mysql_sec')->table('product')->where('product_id',$product_id)->first();
                    
        return view('protocol.admin.product.edit_info_highlight',compact("admin_email","admin","logo","title","product"));
    }

    public function updateInfoHighlight( Request $request ){
        $id = $request->id;
        dd($id);
    }

    public function addProductImages(Request $request){
        
        $product_id = $request->product_id;
        $title = "Add Product Images";
        $admin_email=Session::get('bamaAdmin');
        $admin= DB::connection('mysql_sec')->table('admin')->where('admin_email',$admin_email)->first();
        $logo = DB::connection('mysql_sec')->table('tbl_web_setting')->where('set_id', '1')->first();
        $product = DB::connection('mysql_sec')->table('product')->where('product_id',$product_id)->first();

        $productImages = DB::connection('mysql_sec')->table('product_images')->where('product_id',$product_id)->get();
                    
        return view('protocol.admin.product.edit_product_images',compact("admin_email","productImages","admin","logo","title","product"));
    }

    public function deleteProductImages(Request $request){
        
        $status = DB::connection('mysql_sec')->table('product_images')->where('id',$request->image_id)->delete();

        if($status){
            return redirect()->back()->withSuccess('Product Images Has Been Deleted');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }

    }

    public function updateProductImages(Request $request){

        $product_id = $request->id;
        $date=date('d-m-Y');

        if($request->hasFile('product_image')){
            
            $product_images = $request->product_image;

            foreach($product_images as $product_image){
                $fileName = $product_image->getClientOriginalName();
                $fileName = str_replace(" ", "-", $fileName);
                $product_image->move('images/product/'.$date.'/', $fileName);
                $product_image = 'images/product/'.$date.'/'.$fileName;


                $data = array(
                    'product_id'=>$product_id,
                    'image'=>$product_image,
                    );
            $status = DB::connection('mysql_sec')->table('product_images')->insert($data);
            }
            

        }

        if($status){
            return redirect()->back()->withSuccess('Product Images Has Been Uploaded');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }

    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $date=date('d-m-Y');
        $product_image = $request->product_image;
        $parent_cat_id = $request->parent_cat_id;
        $cat_id        = $request->cat_id;
    
        
        $this->validate(
            $request,
                [
                    
                    'product_name' => 'required',
                    'parent_cat_id' => 'required',
                    'cat_id' => 'required',
                ],
                [
                    'product_name.required' => 'Enter product name.',
                ]
        );

       $getProduct = DB::connection('mysql_sec')->table('product')
                    ->where('product_id',$product_id)
                    ->first();
                    
        if($request->hasFile('product_image')){
            $product_image = $request->product_image;
            $fileName = $product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('images/product/'.$date.'/', $fileName);
            $product_image = 'images/product/'.$date.'/'.$fileName;
        }
        else{
            $product_image =  $getProduct->product_image;
        }

        $insertproduct = DB::connection('mysql_sec')->table('product')
                       ->where('product_id', $product_id)
                            ->update([
                                'product_name'=>$product_name,
                                'product_image'=>$product_image,
                                'parent_cat_id'=>$parent_cat_id,
                                'cat_id'=> $cat_id,
                               
                            ]);
        
        // if($insertproduct){
        //     return redirect()->back()->withSuccess('Product Updated Successfully');
        // }
        // else{
        //     return redirect()->back()->withErrors("Something Wents Wrong");
        // }
       
       return redirect()->back()->withSuccess('Product Updated Successfully');
       
       
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

}