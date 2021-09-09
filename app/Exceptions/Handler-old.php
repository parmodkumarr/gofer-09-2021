<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
    
                return response()->json(array('status'=>401,'message'=>'Unauthorized ! TOKEN_EXPIRED','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]));
                
            } else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return response()->json(array('status'=>401,'message'=>'Unauthorized ! TOKEN_INVALID','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]));

            } else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {

                return response()->json(array('status'=>401,'message'=>'Unauthorized ! TOKEN_BLACKLISTED','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]));

           }
           if ($exception->getMessage() === 'Token not provided') {

                return response()->json(array('status'=>401,'message'=>'Unauthorized ! Token not provided','image_base_prefix_url'=>'http://technodeviser.com/grocerydelivery/','data'=>[]));

           }
        }

        return parent::render($request, $exception);
    }
}
