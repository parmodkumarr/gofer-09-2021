<?php

namespace App\Http\Controllers\Protocol\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;

class LandingPageController extends Controller{
  
  public function index(){	

  	$products    = '';
  	$subCategory = '';
  	$category    = '';

  	$products = DB::connection('mysql_sec')->table('home_design_section')->where('section_type',1)->get();
  	$subCategory = DB::connection('mysql_sec')->table('home_design_section')->where('section_type',2)->get();
  	$category = DB::connection('mysql_sec')->table('home_design_section')->where('section_type',3)->get();

  	if( count($products) > 0 ){
  		foreach ($products as $key => $row) {
  			$row->section_data = DB::connection('mysql_sec')->table('home_content')->where('section_id',$row->section_type)->get();
  		}
  	}else{
  		$products = array();
  	}

  	if( count($subCategory) > 0 ){
  		foreach ($subCategory as $key => $row) {
  			$row->section_data = DB::connection('mysql_sec')->table('home_content')->where('section_id',$row->section_type)->get();
  		}
  	}else{
  		$products = array();
  	}

  	if( count($products) > 0 ){
  		foreach ($products as $key => $row) {
  			$row->section_data = DB::connection('mysql_sec')->table('home_content')->where('section_id',$row->section_type)->get();
  		}
  	}else{
  		$products = array();
  	}

 	return view('protocol.landing.index');
  }


}