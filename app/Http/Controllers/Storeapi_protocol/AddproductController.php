<?php

namespace App\Http\Controllers\Storeapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AddproductController extends Controller
{
    public function productselect(Request $request)
    {
        $store_id = $request->store_id;
        $selected =  DB::connection('mysql_sec')->table('store_products')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->where('store_products.store_id', $store_id)
                ->get();  
                
        $check=  DB::connection('mysql_sec')->table('store_products')
                ->where('store_id', $store_id)
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
        
    	                     
        if(count($products)>0){
        	$message = array('status'=>'1', 'message'=>'Store Products', 'data'=>$products);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Products not found', 'data'=>[]);
	        return $message;
    	}
        }else{
             $products = DB::connection('mysql_sec')->table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->get();
        
        if(count($products)>0){
        	$message = array('status'=>'1', 'message'=>'Store Products', 'data'=>$products);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Products not found', 'data'=>[]);
	        return $message;
    	}  
        }
      
    }
    
    
    public function add_products(Request $request)
    {
       $store_id=$request->store_id;
       $varient_id =$request->varient_id;
        $stock = $request->stock;	 		   
    	 $stockupdate = DB::connection('mysql_sec')->table('store_products')
                ->update(['store_id'=>$store_id,
                    'stock'=>$stock,
                    'varient_id'=>$varient_id]);
         if($stockupdate){
           	$message = array('status'=>'1', 'message'=>'Product Added');
	        return $message;
         } else{
        	$message = array('status'=>'0', 'message'=>'something went wrong');
	        return $message;
         }
    }
    
     public function delete_product(Request $request)
    {
        $id =$request->p_id;
    	 $delete = DB::connection('mysql_sec')->table('store_products')
                ->where('p_id', $id)
                ->delete();
                
         if($delete){
           	$message = array('status'=>'1', 'message'=>'product deleted successfully');
	        return $message;
         } else{
        	$message = array('status'=>'0', 'message'=>'something went wrong');
	        return $message;
         }        
    }
    
     public function stock_update(Request $request)
    {
        $id =$request->p_id;
        $stock = $request->stock;
    	$stockupdate = DB::connection('mysql_sec')->table('store_products')
                ->where('p_id', $id)
                ->update(['stock'=>$stock]);
                 
       if($stockupdate){
           	$message = array('status'=>'1', 'message'=>'Stock Updated');
	        return $message;
         } else{
        	$message = array('status'=>'0', 'message'=>'something went wrong');
	        return $message;
         }

    }
    
    public function store_products(Request $request)
    {
        $store_id = $request->store_id;
         $storeproducts = DB::connection('mysql_sec')->table('store_products')
                ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join('categories','product.cat_id', '=', 'categories.cat_id')
                ->where('store_id', $store_id)
                ->get();
                
       if($storeproducts){
           	$message = array('status'=>'1', 'message'=>'Store Products', 'data'=>$storeproducts);
	        return $message;
         } else{
        	$message = array('status'=>'0', 'message'=>'something went wrong');
	        return $message;
         }
    }
    
}
