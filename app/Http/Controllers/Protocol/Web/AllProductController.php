<?php

namespace App\Http\Controllers\Protocol\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AllProductController extends Controller
{
    public function products(Request $request)
    {
        $cust_phone=Session::get('bamaCust');
    	 $cust= DB::connection('mysql_sec')->table('users')
    	 		   ->where('user_phone',$cust_phone)
    	 		   ->first();
        $title = "Home";
        $category = DB::connection('mysql_sec')->table('categories')
                  ->get();
        $category_sub = DB::connection('mysql_sec')->table('categories')
                     ->where('level',1)
                     ->get();   
        $category_child = DB::connection('mysql_sec')->table('categories')
                     ->where('level',2)
                     ->get();
        $prod_variant =  DB::connection('mysql_sec')->table('product_varient')
                      ->get();             
        $category_prod = DB::connection('mysql_sec')->table('categories')
                      ->first();
          $parent= $category_prod->parent;           
         if($parent==0)
         {
          $category_s = DB::connection('mysql_sec')->table('categories')
                        ->where('parent',$category_prod->cat_id)
                      ->first();
                      
               if($category_s)
               {
                 $category_c = DB::connection('mysql_sec')->table('categories')
                          ->where('parent',$category_s->cat_id)
                          ->first();  
                    if($category_c)
                    {
                        $products = DB::connection('mysql_sec')->table('product')
                                 ->where('cat_id',$category_c->cat_id)
                                 ->get();   
                    }
                    else
                    {
                       $products = DB::connection('mysql_sec')->table('product')
                     ->where('cat_id',$category_s->cat_id)
                     ->get();    
                    }
                    
               }
               else
               {
                $products = DB::connection('mysql_sec')->table('product')
                         ->where('cat_id',$category_prod->cat_id)
                         ->get();     
               }
           
           
            
         }
                      
    	return view('protocol.web.product.cat_product', compact("title","category","category_sub","category_child","products","prod_variant",'cust','cust_phone'));
    }
    
    public function cate(Request $request)
    {
        $cust_phone=Session::get('bamaCust');
    	 $cust= DB::connection('mysql_sec')->table('users')
    	 		   ->where('user_phone',$cust_phone)
    	 		   ->first();
        $cat_id=$request->cat_id; 
         
         $products =  DB::connection('mysql_sec')->table('product')
                  ->where('cat_id', $cat_id)
                  ->get();
              
         $prod_variant =  DB::connection('mysql_sec')->table('product_varient')
                      ->get();
          $category = DB::connection('mysql_sec')->table('categories')
                  ->get();
        $category_sub = DB::connection('mysql_sec')->table('categories')
                     ->where('level',1)
                     ->get();   
        $category_child = DB::connection('mysql_sec')->table('categories')
                     ->where('level',2)
                     ->get();             
         return view('protocol.web.product.cat_product', compact("category","category_sub","category_child","products","prod_variant",'cust','cust_phone'));             
    }
}
