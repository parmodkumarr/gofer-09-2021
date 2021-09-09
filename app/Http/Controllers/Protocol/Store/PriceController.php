<?php

namespace App\Http\Controllers\Protocol\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class PriceController extends Controller
{
      public function stt_product(Request $request)
    {
        $title = "Products Price/Mrp";
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
                ->where('store_id', $store->store_id)
                ->get();  
                
      
    	return view('protocol.store.products.product', compact('title',"store", "logo","selected"));
          
        }
      
    
    
    
 
    
     public function price_update(Request $request)
    {
        $id =$request->id;
        $mrp = $request->mrp;
        $price = $request->price;
    	 $stockupdate = DB::connection('mysql_sec')->table('store_products')
                ->where('p_id', $id)
                ->update(['mrp'=>$mrp,
                'price'=>$price]);
         if($stockupdate){
            return redirect()->back()->withSuccess('Product prices Updated Successfully'); 
         } else{
         return redirect()->back()->withErrors('something went wrong');
         }

    }


    public function storeProductDiscountUpdate(Request $request){
        $id =$request->id;

        $s_discount_type = $request->discount_type;
        $discount_amount = $request->discount_amount;
        $p = DB::connection('mysql_sec')->table('store_products')->where('p_id', $id)->first();
        $ad =0;
        $sd =0;
        $total_discount=0;
        if($p->discount_type ==1){
          $ad = ($p->discount_amount/100)*$p->mrp;
        }
        if($p->discount_type ==2){
          $ad = $p->mrp - $p->discount_amount;
        }
        if($s_discount_type ==1){
          $sd = ($discount_amount/100)*$p->mrp;
          $td = $sd+$ad;
          $total_discount =($td/$p->mrp)*100;
        }
        if($s_discount_type ==2){
          $sd = $p->mrp - $discount_amount;
          $total_discount = $sd+$ad;
        }

        $stockupdate = DB::connection('mysql_sec')->table('store_products')
                ->where('p_id', $id)
                ->update(['store_discount_type'=>$s_discount_type,
                'store_discount_amount'=>$discount_amount,'total_discount'=>$total_discount]);

        if($stockupdate){
            return redirect()->back()->withSuccess('Product prices Updated Successfully'); 
         } else{
         return redirect()->back()->withErrors('something went wrong');
         }
    }

    public function ProductUpdate(Request $request){
        //echo"<pre>";print_r($request->all());die;
        $mrp = $request->mrp;
        $id =$request->id;
        $s_discount_type = $request->discount_type;
        $discount_amount = $request->discount_amount;
        $price =$mrp;
        $p = DB::connection('mysql_sec')->table('store_products')->where('p_id', $id)->first();
        $ad =0;
        $sd =0;
        $total_discount=0;
        // if($p->discount_type ==2){
        //   $ad = ($p->discount_amount/100)*$mrp;
        // }
        // if($p->discount_type ==1){
        //   $ad = $p->discount_amount;
        // }
        if($s_discount_type ==2){
          $sd = ($discount_amount/100)*$mrp;
          $td = $sd+$ad;
          $total_discount =($td/$mrp)*100;
          $price = $mrp-$td;
        }
        if($s_discount_type ==1){
          $sd = $discount_amount;
          $total_discount = $sd+$ad;
          $price = $mrp - $total_discount;
        }

        $stockupdate = DB::connection('mysql_sec')->table('store_products')
                ->where('p_id', $id)
                ->update(['mrp'=>$mrp,'store_discount_type'=>$s_discount_type,
                'store_discount_amount'=>$discount_amount,'total_discount'=>$total_discount,'price'=>$price]);

        if($stockupdate){
            return redirect()->back()->withSuccess('Product Updated Successfully'); 
         } else{
         return redirect()->back()->withErrors('something went wrong');
         }
    }


}
