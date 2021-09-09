<?php

namespace App\Http\Controllers\Storeapi_protocol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;


class AllCategoriesController extends Controller{

    public function getAllCategories(Request $request){

        $all_categories = DB::connection('mysql_sec')->table('all_categories')->get();
        if(count($all_categories)>0){
            foreach($all_categories as $index => $category){
                $category->categories = DB::connection('mysql_sec')->table('categories_cat_id')->where('section_id',$category->id)->get();
            }
        }
        return apiResponse(true,202,$all_categories);
  
    }

    
}