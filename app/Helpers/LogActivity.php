<?php


namespace App\Helpers;
use Request;
use App\Activity as LogActivityModel;


class LogActivity
{
    // use App\Helpers\LogActivity;
    //use this class like this  App\Helpers\LogActivity::addToLog('My Testing Add To Log.');

    public static function addToLog($subject,$user_id = NULL, $user_role = NULL)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] =  Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] =     Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = $user_id;
        $log['user_role'] =$user_role;
    	LogActivityModel::create($log);
    }

    //use this class like this  App\Helpers\LogActivity::logActivityLists();
    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->get();
    }


}