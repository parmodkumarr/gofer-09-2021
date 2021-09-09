<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $user = JWTAuth::toUser($request->input('token'));
        }catch (JWTException $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return array('status'=>$e->getStatusCode(),'message'=>'Invalid Credentials','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
                //return response()->json(['token_expired'], $e->getStatusCode());
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return array('status'=>$e->getStatusCode(),'message'=>'Token Invalid','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
                //return response()->json(['token_invalid'], $e->getStatusCode());
            }else{
                return array('status'=>$e->getStatusCode(),'message'=>'Token is required','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]);
                //return response()->json(['error'=>'Token is required']);
            }
        }
       return $next($request);
    }
}
