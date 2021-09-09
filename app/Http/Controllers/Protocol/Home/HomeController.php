<?php

namespace App\Http\Controllers\Protocol\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SendSms;
use Carbon\Carbon;
use Validator;
use DB;

class HomeController extends Controller{
    public function index( Request $request){
        $validation = Validator::make($request->all(), [
                'lat' => 'required',
                'lng' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        //$user = auth('api')->user();
        $lat = $request->lat;
        $lng = $request->lng;
        $distance = 20;
        $data = array();
        $store_id =0;
        $stores = DB::connection('mysql_sec')
                  ->select(DB::raw('SELECT store_id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM store HAVING distance < ' . $distance . ' ORDER BY distance') );

        if(count($stores) > 0){
            $store = DB::connection('mysql_sec')->table('store')->where('store_id',$stores[0]->store_id)->first();
            
            if($store){
                $store_id = $store->store_id;
                $owner_id = $store->owner_id;
                //$user->update(['active_store'=>$store_id]);
                $homeDesignSection = DB::connection('mysql_sec')->table('home_design_section')->where('store_id',$store_id)->get();

                if( count($homeDesignSection) > 0 ){
                    foreach ($homeDesignSection as $key => $section) {
                        $data[] = $this->putContentToHomeSections($section,$store);
                    }
                    //echo"<pre>";print_r($data);die;
                }else{
                    return apiResponse(false,422,'Empty ! Plaese add home content');
                }
                
                $senddata['homedata'] =$data;
                $senddata['active_store'] =$store_id;
                $senddata['owner_id'] =$owner_id;
                return apiResponse(true,200,$senddata);
            }
        }else{
            $store = $store = DB::connection('mysql_sec')->table('store')->where('store_id',0)->first();
            $store_id = $store->store_id;
            $owner_id = $store->owner_id;
            $homeDesignSection = DB::connection('mysql_sec')->table('home_design_section')->where('store_id',$store_id)->get();
            if( count($homeDesignSection) > 0 ){
                foreach ($homeDesignSection as $key => $section) {
                    $data[] = $this->putContentToHomeSections($section,$store,true);
                }
            }else{
                return apiResponse(false,422,'Empty ! Plaese add home content');
            }
            $senddata['homedata'] =$data;
            $senddata['active_store'] =$store_id;
            $senddata['owner_id'] =$owner_id;
            return apiResponse(true,200,$senddata);
        }
    }

    //29-6-2021
    public function index_old( Request $request){
        $validation = Validator::make($request->all(), [
                'lat' => 'required',
                'lng' => 'required'
        ]);
        if($validation->fails()) {
            return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        }

        $lat = $request->lat;
        $lng = $request->lng;
        
        $distance = 100;

        // if(!isset($request->lat)){
        //     return array('status'=>500,'message'=>'Please Provide Longitude!','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
        // }
        // if(!isset($request->lat)){
        //     return array('status'=>500,'message'=>'Please Provide Latitude!','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
        // }

        $data = array();
        //for default use only
        // $stores = DB::connection('mysql_sec')->table('store')->where('store_id',1)->paginate(5);
        $stores = DB::connection('mysql_sec')
                    ->select(DB::raw('SELECT store_id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM store HAVING distance < ' . $distance . ' ORDER BY distance') );

        if(count($stores) > 0){
            $stores = DB::connection('mysql_sec')->table('store')->where('store_id',$stores[0]->store_id)->paginate(5);
        }else{
            $stores = DB::connection('mysql_sec')->table('store')->where('owner_id',1)->paginate(5);
        }
        if(count($stores)>0){
            foreach ($stores as $key => $store) {
                $homeDesignSection = DB::connection('mysql_sec')->table('home_design_section')->where('store_id',$store->store_id)->get();
                if( count($homeDesignSection) > 0 ){
                    foreach ($homeDesignSection as $key => $section) {
                        $data[] = $this->putContentToHomeSections($section,$store,true);
                    }
                }else{

                }
            }
                return array('status'=>200,'message'=>'success','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$data);
        }else{
            return array('status'=>400,'message'=>'Empty','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$data);
        }

    }

    public function putContentToHomeSections($section=array(),$store=array(),$default=false){
        //echo"<pre>";print_r($section);die;
        if($section->section_type == 1){
            
            //category
            $categoryId = DB::connection('mysql_sec')->table('home_content')->where('section_id',$section->id)->pluck('category_id')->toArray();
            //$data = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id',$categoryId)->get();
            $data = DB::connection('mysql_sec')->table('store_products')
                    ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                    ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                    ->join('categories', 'categories.cat_id', '=', 'product.parent_cat_id')
                    ->whereIn('categories.cat_id',$categoryId)
                    ->where('store_products.store_id',$store->store_id)
                    ->groupBy('categories.cat_id')
                    ->select('categories.*')
                    ->get();
            //echo "<pre>";print_r($data);die;
            $layout = DB::connection('mysql_sec')->table('home_layouts')->where(['home_section_id'=>$section->id,'store_id'=>$store->store_id])->first();

            $data = $this->getMaxDiscountAccCategories($data,$store->store_id,$section->discount_type);
            
            return array(
                'default'=>$default,
                'store_id'=>$store->store_id,
                'section_table_id'=>$section->id,
                // 'store_name'=>$store->store_name,
                // 'store_phone'=>$store->phone_number,
                // 'store_city'=>$store->city,
                // 'store_lat'=>$store->lat,
                // 'store_lng'=>$store->lng,
                // 'store_email'=>$store->email,
                'is_banner'=>$section->is_banner,
                'section_type'=>"category",
                'section_type_id'=>$section->section_type,
                'section_name'=>$section->name,
                'discount_type'=>$section->discount_type,
                'max_discount'=>$section->discount_amount,
                'layout'=>$layout,
                'data'=>$data
            );

        }elseif($section->section_type == 2){
            
            //sub-category
            // dd($section->section_type);
            $sub_categoryId = DB::connection('mysql_sec')->table('home_content')->where('section_id',$section->id)->pluck('sub_category')->toArray();

            //$data = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id',$sub_categoryId)->get();

            $data = DB::connection('mysql_sec')->table('store_products')
                    ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                    ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                    ->join('categories', 'categories.cat_id', '=', 'product.cat_id')
                    ->whereIn('categories.cat_id',$sub_categoryId)
                    ->where('store_products.store_id',$store->store_id)
                    ->groupBy('categories.cat_id')
                    ->select('categories.*')
                    ->get();
            //echo "<pre>";print_r($data);die;
            
            $layout = DB::connection('mysql_sec')->table('home_layouts')->where(['home_section_id'=>$section->id,'store_id'=>$store->store_id])->first();

            $data = $this->getMaxDiscountAccSubCategories($data,$store->store_id,$section->discount_type);
           // echo"<pre>";print_r($data);die;
            // return array('type'=>"sub-category",'data'=>$data);
            return array(
                'store_id'=>$store->store_id,
                'section_table_id'=>$section->id,
                // 'store_name'=>$store->store_name,
                // 'store_phone'=>$store->phone_number,
                // 'store_city'=>$store->city,
                // 'store_lat'=>$store->lat,
                // 'store_lng'=>$store->lng,
                // 'store_email'=>$store->email,
                'is_banner'=>$section->is_banner,
                'section_type'=>"sub-category",
                'section_type_id'=>$section->section_type,
                'section_name'=>$section->name,
                'discount_type'=>$section->discount_type,
                'max_discount'=>$section->discount_amount,
                'layout'=>$layout,
                'data'=>$data
            );


        }elseif($section->section_type == 3){
            
            //product
            $productId = DB::connection('mysql_sec')->table('home_content')->where('section_id',$section->id)->pluck('product_id')->toArray();
            $layout = DB::connection('mysql_sec')->table('home_layouts')->where(['home_section_id'=>$section->id,'store_id'=>$store->store_id])->first();

            $data = DB::connection('mysql_sec')->table('store_products')
                    ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                    ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                    ->join('categories', 'categories.cat_id', '=', 'product.cat_id')
                    ->whereIn('product.product_id',$productId)
                    ->where('store_products.store_id',$store->store_id)
                    // ->select('product.*','product_varient.quantity as quantity','product_varient.quantity as unit','product_varient.base_mrp as base_mrp','product_varient.base_price as base_price','product_varient.description as description','product_varient.varient_image as varient_image','categories.title as sub_category_name')
                    ->get();
            foreach ($data as $row) {
                $row->section_type = "product";
                $row->section_type_id = 3;
            }
            return array(
                'store_id'=>$store->store_id,
                'section_table_id'=>$section->id,
                // 'store_name'=>$store->store_name,
                // 'store_phone'=>$store->phone_number,
                // 'store_city'=>$store->city,
                // 'store_lat'=>$store->lat,
                // 'store_lng'=>$store->lng,
                // 'store_email'=>$store->email,
                'is_banner'=>$section->is_banner,
                'section_type'=>"product",
                'section_type_id'=>$section->section_type,
                'section_name'=>$section->name,
                'discount_type'=>$section->discount_type,
                'max_discount'=>$section->discount_amount,
                'layout'=>$layout,
                'data'=>$data
            );
        }

    }



    public function get_sub_categories_of_categories(Request $request){

        $validation = Validator::make($request->all(), [
                'cat_id' => 'required',
                'store_id' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $cat_id = $request->cat_id;
        $store_id = $request->store_id;
        // $home_section_id = $request->home_section_id;
        $data = array();
        
            $sub_cat_ids =  DB::connection('mysql_sec')->table('store_products')
                        ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                        ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                        ->where('product.parent_cat_id', $cat_id)
                        ->where('store_products.store_id', $store_id)
                        ->select('product.cat_id as sub_cat')
                        ->groupBy('product.cat_id')
                        ->get();
            if($sub_cat_ids){
                $newArray = array();
                foreach($sub_cat_ids as $row){
                    $newArray[] = $row->sub_cat;
                } 
            }

        $all_categories = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id',$newArray)->get();

        return apiResponse(true,202,$all_categories);

    }


    public function setglobal(){

        $selected =  DB::connection('mysql_sec')->table('store_products')
                    ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                    ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                    ->where('store_products.store_id',$store_id)
                    ->where('product.parent_cat_id',$cat_id)
                    ->get();  
        return $selected;
    }

    public function get_products_of_categories(Request $request){
       $validation = Validator::make($request->all(), [
        'store_id' => 'required',
        'sub_cat_id' => 'required',
        'parent_cat_id' => 'required',
        ]);
        if($validation->fails()) {
          return apiResponse(false,406,$validation->getMessageBag());
        } 
        $store_id = $request->store_id;
        $sub_cat_id = $request->sub_cat_id;
        $parent_cat_id = $request->parent_cat_id;

        $sub_cat_ids =  DB::connection('mysql_sec')->table('store_products')
                        ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                        ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                        ->where('store_products.store_id', $store_id)
                        ->where('product.cat_id', $sub_cat_id)
                        ->where('product.parent_cat_id', $parent_cat_id)
                        // ->select('product.*')
                        // ->groupBy('product.cat_id')
                        ->get();

        // $products = DB::connection('mysql_sec')->table('product')->where('cat_id',$sub_cat_id)->get();
        return apiResponse(true,202,$sub_cat_ids);
    }


    function apiResponse($success, $code, $reply, $extra = []){

        $response = [
            'status' => $code,
            'success' => $success,
            'message' => '',
            'errors' => [],
            'result' => [],
            'result_obj' => new ArrayObject(),
            'extra' => $extra ? $extra : new ArrayObject(),
        ];

        if ($code == 200) {
            $response['result_obj'] = $reply;
        } elseif ($code == 404) {
            $response['result'] = $reply;
        } elseif ($code == 406) {
            $response['errors'] = apiErrors($reply);
        } elseif ($code == 201){                 $response['result'] = $reply;          }else {
            $response['message'] = $reply;
        }
        return response()->json($response);
    }
    public function getAllCategoriesList(Request $request){
        $validation = Validator::make($request->all(), [
                'store_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $store_id = $request->store_id;

        $cates = DB::connection('mysql_sec')->table('store_products')
                        ->join('product_varient','store_products.varient_id','=','product_varient.varient_id')
                        ->join('product','product_varient.product_id','=','product.product_id')
                        ->join('categories','categories.cat_id','=','product.parent_cat_id')
                        ->select('categories.*')
                        ->groupBy('categories.cat_id')
                        ->where('store_products.store_id', $store_id)->get();

        foreach($cates as $cate){
          $cate->data = DB::connection('mysql_sec')->table('store_products')
                        ->join('product_varient','store_products.varient_id','=','product_varient.varient_id')
                        ->join('product','product_varient.product_id','=','product.product_id')
                        ->join('categories','categories.cat_id','=','product.cat_id')
                        ->select('categories.*')
                        ->where('store_products.store_id', $store_id)
                        ->where('product.parent_cat_id', $cate->cat_id)
                       ->groupBy('categories.cat_id')
                        ->get();
            // echo "<pre>";print_r($sub);die;
             
        }

        return apiResponse(true,202,$cates);

    }

    public function getAllCategories(Request $request){
        $validation = Validator::make($request->all(), [
                'store_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $store_id = $request->store_id;
        //$sections = DB::connection('mysql_sec')->table('all_categories')->where('store_id',$store_id)->pluck('id')->toArray();

        $sections = DB::connection('mysql_sec')->table('all_categories')->where('store_id',$store_id)->get();
        $result=array();
        if(count($sections) >0){
            foreach($sections as $section){
                $categoryId = DB::connection('mysql_sec')->table('categories_cat_id')->where('section_id',$section->id)->pluck('cat_id')->toArray();
                $cates = DB::connection('mysql_sec')->table('categories')->whereIn('cat_id',$categoryId)->get();
                if(count($cates) >0){
                    $data = $this->getMaxDiscountAccCategories($cates,$store_id,NULL);
                    $rst = array(
                        // 'default'=>$default,
                        'store_id'=>$store_id,
                        'section_image'=>$section->image,
                        'section_id'=>$section->id,
                        // 'is_banner'=>$section->is_banner,
                        'section_type'=>"category",
                        // 'section_type_id'=>$section->section_type,
                        'section_name'=>$section->title,
                        'discount_type'=>$section->discount_type,
                        'max_discount'=>$section->discount_amount,
                        'data'=>$data
                    );

                    array_push($result,$rst);
                }
                
            }
           return apiResponse(true,202,$result); 
        }
        return apiResponse(false,422,'Empty ! Plaese add home content');
    }


    public function getProductDetail(Request $request,$store=null,$product=null){
        $validation = Validator::make($request->all(), [
                'store_id' => 'required',
                'product_id' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $store_id = $request->store_id;
        $product_id = $request->product_id;
        
        $productDetail = DB::connection('mysql_sec')->table('store_products')
                        ->join('product_varient','store_products.varient_id','=','product_varient.varient_id')
                        ->join('product','product_varient.product_id','=','product.product_id')
                        ->where('store_products.store_id', $store_id)
                        ->where('product.product_id',$product_id)->first();

        $productDetail->product_images = DB::connection('mysql_sec')->table('product_images')->where('product_id',$product_id)->get();
        $productDetail->highlight = DB::connection('mysql_sec')->table('product_highlight_info')->where('type',"Highlight")->get();
        $productDetail->Info = DB::connection('mysql_sec')->table('product_highlight_info')->where('type',"Info")->get();

        return apiResponse(true,200,$productDetail);
    }

    public function getRelatedProduct(Request $request){
        $validation = Validator::make($request->all(), [
                'store_id' => 'required',
                'product_id' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $store_id = $request->store_id;
        $product_id = $request->product_id;
        $limit = 9;
        if(isset($request->limit)){
            if($request->limit == 'full'){
                $limit = 200;
            }
        }

        $productDetail = DB::connection('mysql_sec')->table('product')
                        ->join('store_products','store_products.varient_id','=','product.product_id')
                        ->join('product_varient','product_varient.product_id','=','store_products.varient_id')
                        ->where('store_products.store_id', $store_id)
                        ->select('product.*')
                        ->where('product.product_id',$product_id)->first();

        $cat_id = $productDetail->cat_id;

        $categoryProducts =  DB::connection('mysql_sec')->table('product')
                            ->join('store_products', 'store_products.varient_id', '=', 'product.product_id')
                            ->join('product_varient','product_varient.product_id','=','store_products.varient_id')
                            ->where('store_products.store_id',$store_id)
                            ->where('product.cat_id',$cat_id)
                            ->limit($limit)
                            ->get();

        foreach($categoryProducts as $product){
            $product->product_images = DB::connection('mysql_sec')->table('product_images')->where('product_id',$product->product_id)->get();
            $product->highlight = DB::connection('mysql_sec')->table('product_highlight_info')->where('type',"Highlight")->get();
            $product->Info = DB::connection('mysql_sec')->table('product_highlight_info')->where('type',"Info")->get();
        }
          
        return apiResponse(true,202,$categoryProducts);
    }


    public function fetchLocation_old(Request $request){
        
        $address = $request->address;
        $map = DB::connection('mysql_sec')->table('map_api')->first();
        $api_key = $map->map_api_key;
        // $api_key = "AIzaSyBwQ4t0rwCyVmkAkpqT-5VqEQsD1KiB4_g";
        // $api_key = "AIzaSyADlk166150RMLLGby78Ayq9kUKyAdHtp0";

        sleep(5);
        $address = str_replace(" ", "+", $address);
        $region = 'IN';
        $url =    "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$api_key&region=$region";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
         
        curl_close($ch);
        $response_a = json_decode($response);

        $lat = $response_a->results[0]->geometry->location->lat;
        $long = $response_a->results[0]->geometry->location->lng;
        // $latlon = array($lat, $long);
        // var_dump($response_a);
        // var_dump($latlon);
        

        $lat = $response_a->results[0]->geometry->location->lat;
        $lng = $response_a->results[0]->geometry->location->lng;
        
        $responseData = array();
        $responseData['lat'] = $lat;
        $responseData['lng'] = $lng;

        return array('status'=>200,'message'=>'Success!','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$responseData);

    }


    public function fetchLocation(Request $request){
        $validation = Validator::make($request->all(), [
        'owner_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $address = $request->address;
        $owner_id = $request->owner_id;
        $stores = DB::connection('mysql_sec')->table('store')
        ->leftjoin('store_owner','store.owner_id','=','store_owner.id')->select('*')
        ->where('address','like','%'.$address.'%')->where('store.owner_id','=',$owner_id)->get();
        
        return apiResponse(true,202,$stores);        
    }


    public function getNearestStore(Request $request){

        $lat = $request->lat;
        $lng = $request->lng;
        $distance = 200;

        $results = DB::connection('mysql_sec')
                    ->select(DB::raw('SELECT store_id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM store HAVING distance < ' . $distance . ' ORDER BY distance') );

        return array('status'=>200,'message'=>'Success!','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$results);

    }


    public function  getMaxDiscountAccCategories($data=array(),$store_id=null,$discount_type=null){

        if(count($data)>0){

            foreach($data as $index =>$row){
                $cat_id =$row->cat_id;
                //$store_id = $store_id;
                $type = $discount_type;

                $sub_categories = DB::connection('mysql_sec')->table('categories')->where('parent',$cat_id)->pluck('cat_id')->toArray();
                $maxDiscount =  DB::connection('mysql_sec')->table('store_products')
                                    ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                                    ->join('product','product.product_id','=','product_varient.product_id')
                                    ->where('store_products.store_id',$store_id)
                                    ->whereIn('product.cat_id',$sub_categories)
                                    //->where('store_products.store_discount_type', $type)
                                    ->select('store_products.*',\DB::raw('(CASE 
                        WHEN store_products.store_discount_type = "1" THEN  store_products.total_discount/ store_products.mrp *100
                        WHEN store_products.store_discount_type = "2" THEN store_products.total_discount
                        ELSE 0
                        END) AS percentageDiscount'))
                                    ->orderBy('percentageDiscount','DESC')
                                    ->first();
                //echo "<pre>";print_r($maxDiscount);die;
                $row->section_type = "category";
                $row->section_type_id = 1;
                if($maxDiscount){
                    $row->discount_type = $maxDiscount->store_discount_type;
                    $row->max_discount  = $maxDiscount->total_discount;
                }else{
                    $row->discount_type = 0;
                    $row->max_discount  = 0;
                }

            }
        }
        
        return $data; 
    }



    public function  getMaxDiscountAccSubCategories($data=array(),$store_id=null,$discount_type=null){

        if(count($data)>0){

            foreach($data as $index =>$row){
                $cat_id = $row->cat_id;
                //$store_id = $store_id;
                $type = $discount_type;

                $maxDiscount =  DB::connection('mysql_sec')->table('store_products')
                                    ->join('product_varient', 'store_products.varient_id', '=', 'product_varient.varient_id')
                                    ->join('product','product.product_id','=','product_varient.varient_id')
                                    ->where('store_products.store_id',$store_id)
                                    ->where('product.cat_id', $cat_id)
                                    //->where('store_products.store_discount_type', $type)
                                    ->select('store_products.*',\DB::raw('(CASE 
                        WHEN store_products.store_discount_type = "1" THEN  store_products.total_discount/ store_products.mrp *100
                        WHEN store_products.store_discount_type = "2" THEN store_products.total_discount
                        ELSE 0
                        END) AS percentageDiscount'))
                                    ->orderBy('percentageDiscount','DESC')
                                    ->first();
                //echo"<pre>";print_r($maxDiscount);die;
                $row->section_type = "sub-category";
                $row->section_type_id = 2;
                if($maxDiscount){
                    $row->discount_type = $maxDiscount->store_discount_type;
                    $row->max_discount  = $maxDiscount->total_discount;
                }else{
                    $row->discount_type = 0;
                    $row->max_discount  = 0;
                }

            }
        }
        
        return $data; 
    }





    public function  getTest($data){
        $cat_id = 8;
        $store_id = 1;
        $type = 'Flat';

        $sub_categories = DB::connection('mysql_sec')->table('categories')->where('parent',$cat_id)->pluck('cat_id')->toArray();
        $categoryProducts =  DB::connection('mysql_sec')->table('product')
                            ->join('store_products', 'store_products.varient_id', '=', 'product.product_id')
                            ->join('product_varient','product_varient.product_id','=','store_products.varient_id')
                            ->where('store_products.store_id',$store_id)
                            ->whereIn('product.cat_id',$sub_categories)
                            ->where('store_products.discount_type', $type)
                            ->select('store_products.*')
                            ->orderBy('store_products.discount_amount','DESC')
                            // ->where('product.cat_id',$cat_id)
                            // ->limit($limit)
                            ->first();

        $type = $categoryProducts->discount_type;
        $amount = $categoryProducts->discount_amount;

        dd($amount);

        dd($categoryProducts);
    }

}

