<?php

namespace App\Http\Controllers\Protocol\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SendSms;
use Carbon\Carbon;
use Validator;
use JWTAuth;
use Auth;
use DB;

class CartController extends Controller{



    public function addToCart(Request $request){
        $validation = Validator::make($request->all(), [
                'product_id' => 'required',
                'varient_id' => 'required',
                'IsAddType' => 'required',
                'store_id' => 'required',
                //'quantity' => 'required',
                'unit' => 'required',
        ]);
        if($validation->fails()) {
           return apiResponse(false,406,$validation->getMessageBag());
        }
        $user = auth('api')->user();
        $product_id = $request->product_id;
        $varient_id = $request->varient_id;
        $store_id = $request->store_id;
        //$quantity =1;
        //$quantity = (int)$request->quantity;
        $unit = $request->unit;
        $user_id = $user->user_id;
        $increment_value = $request->increment_value;
        $IsAddType = $request->IsAddType;

        // $product_detail = DB::connection('mysql_sec')->table('product')->join('store_products', 'store_products.varient_id', '=', 'product.product_id')->join('product_varient','product_varient.product_id','=','store_products.varient_id')->where('product.product_id',$product_id)->first();

        $product_detail = DB::connection('mysql_sec')->table('store_products')
            ->leftjoin('product_varient', 'product_varient.varient_id', '=', 'store_products.varient_id')
            ->leftjoin('product','product.product_id','=','product_varient.product_id')
            ->select('store_products.*','product_varient.description','product_varient.unit','product_varient.increment_value','product.product_name')
            ->where('product.product_id',$product_id)
            ->where('store_products.store_id',$store_id)
            ->first();
//echo"<pre>";print_r($product_detail);die;
        // if($quantity > $product_detail->quantity){
        //     $quantity = (int)$product_detail->quantity;
        // }
        $store_discount_amount = $product_detail->store_discount_amount;   
        $store_discount_type  = $product_detail->store_discount_type; 
        $total_discount   = $product_detail->total_discount;

        $discount_type = $product_detail->discount_type;
        $discount_amount = $product_detail->discount_amount;
        $price = $product_detail->mrp;
        $final_price = $product_detail->price;  
        $product_name = $product_detail->product_name;
        $product_description = $product_detail->description;
        $in_stock = $product_detail->stock;

        $if_exist = DB::connection('mysql_sec')->table('cart_items')->where(['product_id'=>$product_id,'varient_id'=>$varient_id,'user_id'=>$user_id])->first();
        if($if_exist){
            $lastquantity =$if_exist->quantity;
        }else{
            $lastquantity =0;
        }
        if($IsAddType == 1){
            if($unit == 'gm' || $unit == 'ml'){
                $quantity = $lastquantity + 100;
            }else{
              $quantity = $lastquantity + 1;
              if($quantity >= $product_detail->stock){
                $quantity = $product_detail->stock;
              }
            }
            
        }
        if($IsAddType == 2){
            if($lastquantity >1){
                if($unit == 'gm' || $unit == 'ml'){
                $quantity = $lastquantity - 100;
                }else{
                    $quantity = $lastquantity - 1;
                }
            }else{
                $quantity =1;
            }
        }

        if($in_stock ==0 || $in_stock < $quantity){
            return apiResponse(false,422,'Out of Stock');
        }
        //echo $quantity;die;
        $final_price = $product_detail->mrp;
        if($store_discount_type ==2){
          $dis = ($total_discount/100)* $final_price;
          $final_price = $final_price-$dis;
        }
        if($store_discount_type ==1){
          $final_price = $final_price - ($total_discount);
        }
        $data = array(
                'product_id' => $product_id,
                'varient_id' => $varient_id,
                'user_id' => $user_id,
                'store_id' => $store_id,
                'discount_type' => $discount_type,
                'discount_amount' => $discount_amount,
                'price' => $price,
                'final_price' => $final_price,
                'product_name' => $product_name,
                'product_description' => $product_description,
                'quantity' => $quantity,
                'unit' => $product_detail->unit,
                'store_discount_amount' => $store_discount_amount,
                'store_discount_type' => $store_discount_type,
                'total_discount' => $total_discount,
                'increment_value' => $product_detail->increment_value,
                'in_stock' => $in_stock,
            );
        //echo"<pre>";print_r($data);die;
        try {
            if($if_exist){
               // return array('status'=>201,'message'=>'Same Product Already exist in your Cart','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
               //DB::connection('mysql_sec')->enableQueryLog();
                $response = DB::connection('mysql_sec')->table('cart_items')
                ->where(['product_id'=>$product_id,'varient_id'=>$varient_id,'user_id'=>$user_id])
                ->update($data);
                //dd(DB::connection('mysql_sec')->getQueryLog());
            }else{
                $response = DB::connection('mysql_sec')->table('cart_items')->insert($data);  
            }
        }catch (\Exception $e) {
            return 'Caught exception: '.  $e->getMessage(). "\n";
        }
        return apiResponse(true,204,'Product has been added to Cart');
        // if($response){
        //     return array('status'=>200,'message'=>'Product has been added to Cart','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$response);
        // }else{
        //     return array('status'=>500,'message'=>'Something Went wrong','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
        // }

    }

    public function removeCartProduct(Request $request){
        
        $validation = Validator::make($request->all(), [
                'id' => 'required',
        
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $id = $request->id;
        $response = DB::connection('mysql_sec')->table('cart_items')->where('id',$id)->delete();

        if($response){
            return apiResponse(true,204,'Cart Product has been Removed!');
        }else{
            return apiResponse(true,422,'Something Went wrong');
        }
        
    }


    public function getSubTotalOfCartItems(Request $request){      
        $validation = Validator::make($request->all(), [
                //'user_id' => 'required|integer',
                'store_id' => 'required|integer',
        
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $tax = env('TaxtRate') ? env('TaxtRate') : 0;
        $final_price = 0;
        $total_discount = 0;
        $mrp_price=0;
        $total_items = 0;
        $delivery_charges = 49;
        $user = auth('api')->user();
        $user_id  = $user->user_id;
        $store_id = $request->store_id;
    
        //$cartItems = DB::connection('mysql_sec')->table('cart_items')
        //->where(['user_id'=>trim($user_id),'store_id'=>$store_id])->get();
        $cartItems = DB::connection('mysql_sec')->table('cart_items')
        ->where(['user_id'=>trim($user_id)])->get();

        DB::connection('mysql_sec')->table('cart_items')
        ->where(['user_id'=>trim($user_id)])->update(['store_id'=>$store_id]);

        if(count($cartItems)>0){
            foreach ($cartItems as $key => $row) {
                
                $pro = DB::connection('mysql_sec')->table('store_products')
                ->where('varient_id','=',$row->varient_id)->where('store_id',$store_id)->first();

                $varient = DB::connection('mysql_sec')->table('product_varient')
                        ->select('product.*')
                        ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                        ->where('product_varient.varient_id','=',$row->varient_id)->first();



                $row->product_image = $varient ? $varient->product_image : NULL;

                $row->out_of_stock =false;

                // if($row->store_id !=$store_id ){
                //     $row->out_of_stock =true; 
                // }else{
                //     $row->out_of_stock =false; 
                // }
                if($pro){
                    if($pro->stock != 0){
                       if($pro->stock < $row->quantity){
                        $row->out_of_stock =true; 
                        }else{
                            $row->out_of_stock =false; 
                        } 
                    }else{
                        $row->out_of_stock =true; 
                    }
                    
                    $cart = array(
                    'discount_type'=>$pro->discount_type ,
                    'discount_amount'=>$pro->discount_amount,
                    'store_discount_type'=>$pro->store_discount_type,
                    'store_discount_amount'=>$pro->store_discount_amount,
                    'total_discount'=>$pro->total_discount,
                    'price'=>$pro->mrp,
                    'final_price'=>$pro->mrp-$pro->total_discount,
                    'in_stock'=> $pro->stock,
                    );
                    DB::connection('mysql_sec')->table('cart_items')
                    ->where(['id'=>$row->id])->update($cart);
                }else{
                    $row->out_of_stock =true; 
                }
            }
            
        }

        if(count($cartItems)>0){
            foreach ($cartItems as $key => $row) {
                $row->selected_quantity = $row->quantity;
                $row->quantity = $row->in_stock;
                $final_price += $row->selected_quantity * $row->final_price;
                $mrp_price += $row->selected_quantity * $row->price;
                $total_discount += $row->selected_quantity * $row->total_discount;
                $total_items = count($cartItems);
                $delivery_charges = 0;
            }
            
        }

        foreach($cartItems as $index => $row){
            $row->base_mrp = $row->price;
            $row->base_price = $row->final_price;
            unset($row->price);
            unset($row->final_price);
        }

        $data['cartItems'] = $cartItems;
        $data['subtotal'] = [
                                'mrp_price'=>$mrp_price,
                                'final_price'=>$final_price,
                                'discount_amount'=>$total_discount,
                                'total_items'=>$total_items,
                                'delivery_charges'=>$delivery_charges,
                                'tax'=>$tax
                            ];

        return apiResponse(true,200,$data);
    }

    public function user_address_list(Request $request)
    {  
        // $validation = Validator::make($request->all(), [
        //     'user_id' => 'required',
        // ]);
        // if($validation->fails()) {
        //     return array('status'=>500,'message'=>'Validation Alert','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>$validation->getMessageBag());
        // }
        $user = auth('api')->user();
        $user_id = $user->user_id;
        $address = DB::connection('mysql_sec')->table('address')
        ->where('user_id','=',$user_id)->get();

        return apiResponse(true,202,$address);
    }

    public function showAddress(Request $request)
    { 
        $validation = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $address = DB::connection('mysql_sec')->table('address')
        ->where('address_id','=',$request->address_id)->first();

        return apiResponse(true,200,$address);
    }

    public function deleteAddress(Request $request)
    { 
        $validation = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $address = DB::connection('mysql_sec')->table('address')
        ->where('address_id','=',$request->address_id)->delete();
        return apiResponse(true,204,'Delete Successfully');
    }

    public function user_address_add(Request $request)
    {  
        $validation = Validator::make($request->all(), [
            //'user_id' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            //'city' => 'required',
            'society' => 'required',
            'house_no' => 'required',
            //'landmark' => 'required',
            'state' => 'required',
            //'pincode' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'full_address' => 'required',
            'address_type' => 'required',
            "other_address" => "required_if:address_type,==,3"
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $data = $request->all();
        $adds = getAddress($data['lat'],$data['lng']);
        $data = array_merge($data,$adds);
        $user = auth('api')->user();
        $user_id = $user->user_id;
        $user->update( ['user_name'=>$data['receiver_name'] ]);
        if(isset($request->address_id)){
            $response = DB::connection('mysql_sec')->table('address')
            ->where('address_id','=',$request->address_id)
            ->where('user_id','=',$user_id)->update($data);  
        }else{
            $response = DB::connection('mysql_sec')->table('address')->insert($data);
        }
        return apiResponse(true,204,'Address Added Successfully');
        
    }
    public function activeAddress(Request $request){
        $validation = Validator::make($request->all(), [
            //'user_id' => 'required',
            'address_id' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        $user = auth('api')->user();
        $user_id = $user->user_id;
        $response = DB::connection('mysql_sec')->table('address')
            ->where('user_id','=',$user_id )
            ->update(['select_status'=>0]);


        $response = DB::connection('mysql_sec')->table('address')
            ->where('address_id','=',$request->address_id)
            ->where('user_id','=',$user_id)
            ->update(['select_status'=>1]);
        return apiResponse(true,204,'Address Updated successfully');
    }
    public function getStoreTimeSlot(Request $request) {

        $validation = Validator::make($request->all(), [
            'store_id' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }else{
            //DaysNum();
            $days  = array(
                'Sun',
                'Mon',
                'Tues',
                'Wed',
                'Thurs',
                'Fri',
                'Sat'
            );
            
            $timeslot = DB::connection('mysql_sec')->table('store_time_slot')
            ->where('store_id','=',$request->store_id)->orderBy('time_slot', 'asc')->orderby('day','asc')->get();
            $dataar =[];
            $result=[];
            if(count($timeslot) > 0){
                $cday = Carbon::now()->next()->dayOfWeek;
                foreach($timeslot as $value) {
                    $dataar[$value->day][] =$value;
                }

                $i = $cday;
                $data=[];
                $addDay =0;
                foreach ($dataar as $key =>$value) {
                    if($i >6){
                        $i =0;
                    }
                    if(isset($dataar[$i])){
                        //$data[$i][] =  $dataar[$i];
                        $date = Carbon::now()->addDays($addDay);
                        $test['day']=$i;
                        $test['dayvalue']=$days[$i];
                        $test['date']= $date->format('d/m/Y');
                        $test['timeslot']=$dataar[$i];
                        array_push($result, $test);
                        $addDay++;
                    }
                    $i++;
                }//die;
            }
            return apiResponse(true,202,$result);
        }
    }

    public function getCheckOut(Request $request){
        
        $validation = Validator::make($request->all(), [
            //'user_id' => 'required',
            'store_id' => 'required'
        ]);
        if($validation->fails()) {
            return apiResponse(false,406,$validation->getMessageBag());
        }
        // $final_price = 0;
        // $total_discount = 0;
        // $mrp_price=0;
        // $total_items = 0;
        // $delivery_charges = 49;
        $user = auth('api')->user();
        $user_id = $user->user_id;
        $store_id = $request->store_id;
        $data=array();
        // $cartItems = DB::connection('mysql_sec')->table('cart_items')->where(['user_id'=>trim($user_id),'store_id'=>$store_id])->get();
        $cartItems = DB::connection('mysql_sec')->table('cart_items')->where(['user_id'=>$user_id])->get();

        if(count($cartItems)>0){
            foreach($cartItems as $index => $row){
                $product_id = $row->product_id;
                $varient_id = $row->varient_id;
                $quantity   = $row->quantity; 
                // $product_detail = DB::connection('mysql_sec')->table('product')
                //             ->join('store_products', 'store_products.varient_id', '=', 'product.product_id')
                //             ->join('product_varient','product_varient.product_id','=','store_products.varient_id')
                //             ->where('product.product_id',$product_id)
                //             ->first();

                $product_detail = DB::connection('mysql_sec')->table('store_products')
                            ->join('product_varient','product_varient.varient_id','=','store_products.varient_id')
                            ->join('product', 'product.product_id', '=', 'product_varient.product_id')
                            ->where('store_products.store_id',$store_id)
                            ->where('product.product_id',$product_id)
                            ->first();
                $row->product_image =$product_detail->product_image;
                if($product_detail){
                    if($quantity > $product_detail->stock){
                        $row->out_of_stock =true; 
                        array_push($data, $row);
                    }
                }else{
                    $row->out_of_stock =true;
                    array_push($data, $row);
                }
            }
        }

        // if(count($cartItems)>0){
        //     foreach ($cartItems as $key => $row) {
        //         $row->selected_quantity = $row->quantity;
        //         $row->quantity = $row->in_stock;
        //         $final_price += $row->final_price;
        //         $mrp_price += $row->price;
        //         $total_discount += $row->total_discount;
        //         $total_items = count($cartItems);
        //         $delivery_charges = 0;
        //     }
            
        // }

        // $data['cartItems'] = $cartItems;
        // $data['subtotal'] = [
        //                     'mrp_price'=>$mrp_price,
        //                     'final_price'=>$final_price,
        //                     'discount_amount'=>$total_discount,
        //                     'total_items'=>$total_items,
        //                     'delivery_charges'=>$delivery_charges,
        //                 ];

        return apiResponse(true,202,$data);
    }

    public function chooseAddress(Request $request){
        $validation = Validator::make($request->all(), [
            'address_id' => 'required',
            'store_id' => 'required',
            //'user_id' => 'required',
        ]);
        if($validation->fails()){
            return apiResponse(false,406,$validation->getMessageBag());
        }

        $tax = env('TaxtRate') ? env('TaxtRate') : 0;
        $final_price = 0;
        $total_discount = 0;
        $mrp_price=0;
        $total_items = 0;
        $delivery_charges = 49;
        $min_cart_value =0;
        $del_charge =0;
        $distance =0;

        $user = auth('api')->user();
        $user_id = $user->user_id;

        $store_id = $request->store_id;
        $address_id = $request->address_id;

        $cartItems = DB::connection('mysql_sec')->table('cart_items')
        ->where(['user_id'=>$user_id,'store_id'=>$store_id])->get();

        if(count($cartItems)>0){
            foreach ($cartItems as $key => $row) {
                $final_price += $row->quantity * $row->final_price;
                $mrp_price += $row->quantity * $row->price;
                $total_discount += $row->quantity * $row->total_discount;
                $total_items = count($cartItems);
            }
            
        }
        //$final_price=400;
        DB::connection('mysql_sec')->table('address')->where('user_id',$user_id)->update(['select_status'=>0]);
        DB::connection('mysql_sec')->table('address')->where('address_id',$address_id)->update(['select_status'=>1]);
        $check   = DB::connection('mysql_sec')->table('freedeliverycart')->first();
        $address = DB::connection('mysql_sec')->table('address')->where('address_id',$address_id)->first();
        $store = DB::connection('mysql_sec')->table('store')->where('store_id',$store_id)->first();

        $distance = $this->distance($address->lat,$address->lng,$store->lat,$store->lng,'K');

        if($check){
           $min_cart_value = $check->min_cart_value;
           $del_charge = $check->del_charge;
        }

        if($final_price > $min_cart_value){
            $delivery_charges = 0;
        }else{
            $delivery_charges = $distance* $del_charge;
        }

        $total_price = $final_price + $delivery_charges;

        $data['subtotal'] = [
            'mrp_price'=>$mrp_price,
            'final_price'=>$final_price,
            'discount_amount'=>$total_discount,
            'total_items'=>$total_items,
            'total_price'=>$total_price+($tax/100*$total_price),
            'delivery_charges'=>$delivery_charges,
            'distance'=>$distance,
            'address_id'=>$address->address_id,
            'tax'=>$tax
        ];

        return apiResponse(true,200,$data);
    }

}