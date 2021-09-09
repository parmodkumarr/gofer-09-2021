<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function uploadImage($image, $folder) {
	    $random_number = mt_rand(100000, 999999);
	    $offerimgname = $random_number .time(). $image->getClientOriginalName();
	    //$path =$image->storeAs( '/images/'.$folder.'/', $offerimgname, 'public'); 
	    $path = 'images/'.$folder.'/'; 
	    //echo $path;die;
	    $image->move($path, $offerimgname);
	    return $name =$path . $offerimgname; //path;
	}

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
      if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
      }
      else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            $dis = $miles * 1.609344;
            return number_format($dis,2);
        } else if ($unit == "N") {
            $dis = $miles * 0.8684;
            return number_format($dis,2);
        } else {
          return number_format($miles,2);
        }
      }
    }
}
