<?php

namespace App\Http\Controllers\Api_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
class SearchController extends Controller
{
 
    public function search(Request $request)
    {
        $validation = Validator::make($request->all(), [
                'keyword' => 'required',
                'lat' => 'required',
                'lng' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $keyword = $request->keyword;
        $lat = $request->lat;
        $lng = $request->lng;
       
       $nearbystore = DB::connection('mysql_sec')->table('store')
                    ->select('del_range','store_id',DB::connection('mysql_sec')->raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(store.lat)) 
                    * cos(radians(store.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(store.lat))) AS distance"))
                  ->where('store.del_range','>=','distance')
                //   ->where('store.city',$city)
                  ->orderBy('distance')
                  ->first();
    if($nearbystore->del_range >= $nearbystore->distance)  { 
        $prod = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
			     ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
			     ->select('product.product_name','product.product_id')
                 ->groupBy('product.product_name','product.product_id')
                 ->where('store_products.store_id', $nearbystore->store_id)
                ->where('product.product_name', 'like', '%'.$keyword.'%')
                ->get();

        if(count($prod)>0){
            $result =array();
            $i = 0;

            foreach ($prod as $prods) {
                array_push($result, $prods);

                $app = json_decode($prods->product_id);
                $apps = array($app);
                $app = DB::connection('mysql_sec')->table('store_products')
					   ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                     ->Leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
                         ->select('store_products.store_id','store_products.stock','product_varient.varient_id', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity','deal_product.deal_price', 'deal_product.valid_from', 'deal_product.valid_to')
                         ->where('store_products.store_id', $nearbystore->store_id)
                        ->whereIn('product_varient.product_id', $apps)
                        ->get();
                        
                $result[$i]->varients = $app;
                $i++; 
             
            }

            return apiResponse(true,202,$prod);
        }
        else{
            return apiResponse(false,204,'Products not found');
        }
      }
       else{
           return apiResponse(false,204,'No Products Found Nearby'); 
       }
    }

    public function search2(Request $request){
        $validation = Validator::make($request->all(), [
               'keyword' => 'required',
                'store_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $keyword = $request->keyword;
        $store_id = $request->store_id;
        $status ='0';
        $message='Products not found';
        $result =array();
            $cates = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                 ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join ('categories', 'categories.cat_id', '=', 'product.parent_cat_id')
                 ->select('product.*')
                 //->groupBy('categories.cat_id')
                 ->groupBy('product.product_id')
                ->where('categories.title', 'like', '%'.$keyword.'%')
                ->get();

            $subcates = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                 ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join ('categories', 'categories.cat_id', '=', 'product.cat_id')
                 ->select('product.*')
                ->where('categories.title', 'like', '%'.$keyword.'%')
                //->groupBy('categories.cat_id')
                ->groupBy('product.product_id')
                ->get();
            //echo"<pre>";print_r($cates);die;
            $prod = DB::connection('mysql_sec')->table('store_products')
                 ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                 ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->select('product.*')
                 ->groupBy('product.product_name','product.product_id')
                 ->where('store_products.store_id', $store_id)
                ->where('product.product_name', 'like', '%'.$keyword.'%')
                ->get()->toArray();
        if(count($cates) > 0){
            foreach ($cates as $cate) {
               array_push($prod, $cate);
            }
        }
        
        if(count($subcates) > 0){
            foreach ($subcates as $scate) {
               array_push($prod, $scate);
            }
        }

        if(count($prod)>0){
            
            $i = 0;
            foreach ($prod as $prods) {
                $prods->type ="3";

                // $app = json_decode($prods->product_id);
                // $apps = array($app);
                $app = DB::connection('mysql_sec')->table('store_products')
                        ->join ('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                        ->select('store_products.store_id','store_products.stock','product_varient.varient_id', 'product_varient.description', 'store_products.price', 'store_products.mrp', 'product_varient.varient_image','product_varient.unit','product_varient.quantity','product_varient.increment_value')
                         ->where('store_products.store_id', $store_id)
                        ->where('product_varient.product_id', $prods->product_id)
                        ->first();
                 $prods->store_id    = $app->store_id; 
                 $prods->stock       = $app->stock; 
                 $prods->varient_id  = $app->varient_id; 
                 $prods->description = $app->description; 
                 $prods->price       = $app->price; 
                 $prods->mrp         = $app->mrp; 
                 $prods->varient_image = $app->varient_image; 
                 $prods->unit = $app->unit; 
                 $prods->quantity = $app->quantity;
                 $prods->increment_value = $app->increment_value;
                 // $prods->valid_from = $app->valid_from; 
                 // $prods->valid_to = $app->valid_to; 

                // $result[$i]->varients = $app;
                // $i++; 
                array_push($result, $prods);
            }
            $message ='Products found';
            $status  ='1';
        }
        // if(count($cates) > 0){
        //     foreach ($cates as $cate) {
        //        $cate->type ="1";
        //        array_push($result, $cate);
        //     }
        //     $message ='Products found';
        //     $status  ='1';
        // }
        
        // if(count($subcates) > 0){
        //     foreach ($subcates as $scate) {
        //        $scate->type ="2";
        //        array_push($result, $scate);
        //     }
        //     $message ='Products found';
        //     $status  ='1';
        // }

        return apiResponse(true,202,$result);
    }
}
