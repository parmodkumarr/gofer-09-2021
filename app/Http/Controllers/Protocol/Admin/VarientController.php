<?php

namespace App\Http\Controllers\Protocol\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class VarientController extends Controller
{
    public function varient(Request $request)
    {   
        $id = $request->id;
        $product= DB::connection('mysql_sec')->table('product_varient')
                ->where('product_id', $id)->paginate(10);

        if($request->ajax()){
           return view('protocol.admin.product.varient.pagination_data',compact('users'))->render();
        }

         
        $p= DB::connection('mysql_sec')->table('product')
            ->where('product_id', $id)->first();
         
        $title=$p->product_name." Varient";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();

        $currency =  DB::connection('mysql_sec')->table('currency')
               ->select('currency_sign')
                ->get();           
        return view('protocol.admin.product.varient.show_varient',compact("admin_email","product","admin","currency","id",'title','logo'));
    }
    
     public function Addproduct(Request $request)
    {
        $id = $request->id;  
        $p= DB::connection('mysql_sec')->table('product')
                 ->where('product_id', $id)
                ->first();
         
        $title=$p->product_name." Varient Addition";
    	 
    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        $product= DB::connection('mysql_sec')->table('product_varient')
                 ->where('product_id', $id)
                ->get();
        $currency =  DB::connection('mysql_sec')->table('currency')
               ->select('currency_sign')
                ->get(); 
        
                
            // echo $id;
         return view('protocol.admin.product.varient.addvarient',compact("admin_email","admin","id",'title','logo'));
    }
    
    
   public function AddNewproduct(Request $request)
    {
         
        $id = $request->id;
        $mrp = $request->mrp;
        $price=$request->price;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $description =$request->description;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

          
        $this->validate(
            $request,
                [
                    'mrp'=>'required',
                    'description'=>'required',
                    'quantity'=>'required',
                    'unit'=>'required',
                    'price'=>'required',
                    'varient_image'=>'required|mimes:jpeg,png,jpg|max:1000',
                ],
                [
                    'mrp.required'=>'enter mrp',
                    'description.required'=>'enter description about product',
                    'mrp.required'=>'enter product MRP',
                    'varient_image.required'=>'select an image',
                    'quantity.required'=>'enter quantity',
                    'unit.required'=>'enter unit'
                ]
        );
                
        if($request->hasFile('varient_image')){
            $image = $request->varient_image;
            $fileName = $image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $image->move('images/product/'.$date.'/', $fileName);
            $image = 'images/product/'.$date.'/'.$fileName;
        }
        else{
            $image = 'N/A';
        }

        
        
        $insert =  DB::connection('mysql_sec')->table('product_varient')
                        ->insert(['product_id'=>$id,'base_mrp'=>$mrp, 'base_price'=>$price,'varient_image'=>$image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description]);
     if($insert){
         return redirect()->back()->withSuccess('Successfully Added');
     }
     else{
     return redirect()->back()->withErrors('something went wrong');
     }
	
    }
    
    public function Editproduct(Request $request)
    {
 
       $varient_id=$request->id;

    	$admin_email=Session::get('bamaAdmin');
    	 $admin= DB::connection('mysql_sec')->table('admin')
    	 		   ->where('admin_email',$admin_email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
        $product= DB::connection('mysql_sec')->table('product_varient')
                 ->where('varient_id', $varient_id)
                ->first();
                
        $p= DB::connection('mysql_sec')->table('product')
                 ->where('product_id', $product->product_id)
                ->first();
         $title=$p->product_name." Varient Update";
         
    	 return view('protocol.admin.product.varient.editvarient',compact("admin_email","admin","product","varient_id",'title','logo'));
   }
    public function Updateproduct(Request $request)
   {
     
        $product_id=$request->id;
         $id = $request->id;
        $mrp = $request->mrp;
        $price=$request->price;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $description =$request->description;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $varient_image = $request->varient_image;
        $discount_type = $request->discount_type;
        $discount_amount = $request->discount_amount;
        
        $getImage = DB::connection('mysql_sec')->table('product_varient')
                     ->where('varient_id',$product_id)
                    ->first();

        $image = $getImage->varient_image;  

        if($request->hasFile('varient_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $varient_image = $request->varient_image;
            $fileName = date('dmyhisa').'-'.$varient_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $varient_image->move('images/product/'.$date.'/', $fileName);
            $varient_image = 'images/product/'.$date.'/'.$fileName;
        }
        else{
            $varient_image = $image;
        }

        if($discount_type == 2){
            $price = $mrp - (($discount_amount/100)*$mrp);
        }else if($discount_type ==1){
            $price = $mrp - $discount_amount;
        }else{
            $discount_amount =0;
            $price =$mrp;
        }
        
       $varient_update = DB::connection('mysql_sec')->table('product_varient')
                            ->where('varient_id', $product_id)
                            ->update(['base_mrp'=>$mrp, 'base_price'=>$price,'varient_image'=>$varient_image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description,'discount_type'=>$discount_type,'discount_amount'=>$discount_amount]);

        $updatestore = ['store_id'=>0,'stock'=>$quantity, 'varient_id'=>$product_id, 'price'=>$price,'mrp'=>$mrp,'discount_type'=>$discount_type,'discount_amount'=>$discount_amount,'store_discount_type'=>$discount_type,'total_discount'=>$discount_amount];

        $instore = DB::connection('mysql_sec')->table('store_products')->where(['varient_id'=>$product_id,'store_id'=>0])->first();
        if($instore){
            DB::connection('mysql_sec')->table('store_products')
                ->where(['varient_id'=>$product_id,'store_id'=>0])
                ->update($updatestore);
        }else{
                DB::connection('mysql_sec')->table('store_products')
                ->insert($updatestore);
        }
                            
        if($varient_update){
            return redirect()->back()->withSuccess('Updated Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong.");
        }
    }
  public function deleteproduct(Request $request)
    {
        $varient_id=$request->id;

        $getfile=DB::connection('mysql_sec')->table('product_varient')
                ->where('varient_id',$varient_id)
                ->first();

        $product_image=$getfile->varient_image;

    	$delete=DB::connection('mysql_sec')->table('product_varient')->where('varient_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($product_image)){
                unlink($product_image);
            }
         
        return redirect()->back()->withSuccess('Deleted Successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	
    
}
