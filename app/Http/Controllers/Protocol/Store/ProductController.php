<?php

namespace App\Http\Controllers\Protocol\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ProductController extends Controller
{
    public function sel_product(Request $request)
    {
        $title = "Add Product";
         $email=Session::get('bamaStore');
    	  $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
        //echo "<pre>";print_r($store);die;
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
         
        $selected =  DB::connection('mysql_sec')->table('store_products')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->where('store_products.store_id', $store->store_id)
                ->orderBy('store_products.stock','asc')
                ->paginate(8);  
                
        $check=  DB::connection('mysql_sec')->table('store_products')
                ->where('store_id', $store->store_id)
                ->get(); 
        if(count($check)>0)  {
        foreach($check as $ch){
            $ch2 = $ch->varient_id;
            $ch3[] = array($ch2);
        }
          $products = DB::connection('mysql_sec')->table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->whereNotIn('product_varient.varient_id', $ch3)
                ->get();    
        
    	return view('protocol.store.products.select', compact('title',"store", "logo","products","selected"));
        }else{
             $products = DB::connection('mysql_sec')->table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->get();
                
            return view('protocol.store.products.select', compact('title',"store", "logo","products","selected"));    
        }
      
    }
    
    
    
      public function st_product(Request $request)
    {
        $title = "Products";
         $email=Session::get('bamaStore');
    	 $store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	  $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
         
        $selected =  DB::connection('mysql_sec')->table('store_products')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->where('store_id', $store->store_id)
                ->orderBy('store_products.stock','asc')
                ->get();  
                
        $check=  DB::connection('mysql_sec')->table('store_products')
                ->where('store_id', $store->store_id)
                ->get(); 
        if(count($check)>0)  {
        foreach($check as $ch){
            $ch2 = $ch->varient_id;
            $ch3[] = array($ch2);
        }
          $products = DB::connection('mysql_sec')->table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->whereNotIn('product_varient.varient_id', $ch3)
                ->get();    
        
    	return view('protocol.store.products.pr', compact('title',"store", "logo","products","selected"));
        }else{
             $products = DB::connection('mysql_sec')->table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->get();
                
            return view('protocol.store.products.pr', compact('title',"store", "logo","products","selected"));    
        }
      
    }
    
    
    public function added_product(Request $request)
    {
        $email=Session::get('bamaStore');
    	$store= DB::connection('mysql_sec')->table('store')
    	 		   ->where('email',$email)
    	 		   ->first();
    	 		   
    	 $logo = DB::connection('mysql_sec')->table('tbl_web_setting')
                ->where('set_id', '1')
                ->first();
          
    $prod = $request->prod;
    
    $countprod = count($prod);

    for($i=0;$i<=($countprod-1);$i++)
        {
            $varient_id = $prod[$i];
            $pr= DB::connection('mysql_sec')->table('product_varient')
                 ->where('varient_id',$varient_id)
                 ->first();
            $stock =0;
            if($store->store_id==0 ||$store->is_default ==1){
                $stock=$pr->quantity;
            }
            $insert2 = DB::connection('mysql_sec')->table('store_products')
                  ->insert(['store_id'=>$store->store_id,'stock'=>$stock, 'varient_id'=>$prod[$i], 'price'=>$pr->base_price,'mrp'=>$pr->base_mrp,'discount_type'=>$pr->discount_type,'discount_amount'=>$pr->discount_amount,'store_discount_type'=>$pr->discount_type,'total_discount'=>$pr->discount_amount]);
        }     
          
         return redirect()->back()->withSuccess('Product Added Successfully');
    }
    
     public function delete_product(Request $request)
    {
        $id =$request->id;
    	 $delete = DB::connection('mysql_sec')->table('store_products')
                ->where('p_id', $id)
                ->delete();
         if($delete){
            return redirect()->back()->withSuccess('Product Removed'); 
         } else{
         return redirect()->back()->withErrors('Something Went Wrong');
         }

    }
    
     public function stock_update(Request $request)
    {
      $id =$request->id;
      $stock = $request->stock;
      $s_p   = DB::connection('mysql_sec')->table('store_products')->where('p_id', $id)->first();
      $p_varient = DB::connection('mysql_sec')->table('product_varient')->where('varient_id',$s_p->varient_id)->first();
      if($p_varient->quantity < $stock){
         return redirect()->back()->withErrors('Please Enter Limited Stock');
      }

      $old_stock = DB::connection('mysql_sec')->table('store_products')
      ->where('p_id', $id)->first();
    	$stockupdate = DB::connection('mysql_sec')->table('store_products')
      ->where('p_id', $id)->update(['stock'=>$stock+$old_stock->stock]);
      $adminstock = $p_varient->quantity - $stock;
      $data['quantity']= $adminstock;
      $data2['stock']= $adminstock;
      //echo"<pre>";print_r($data);die;
        DB::connection('mysql_sec')->table('product_varient')
          ->where('varient_id',$s_p->varient_id)->update($data);

      $def_s = DB::connection('mysql_sec')->table('store_products')
        ->where(['varient_id'=>$s_p->varient_id,'store_id'=>0])->first();
      if($def_s){
        DB::connection('mysql_sec')->table('store_products')
        ->where(['varient_id'=>$s_p->varient_id,'store_id'=>0])->update($data2);
      }

      if($stockupdate){
        return redirect()->back()->withSuccess('Product Stock Updated Successfully'); 
      } else{
        return redirect()->back()->withErrors('something went wrong');
      }
    }
}
