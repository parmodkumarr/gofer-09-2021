<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use BadMethodCallException;
use InvalidArgumentException;
use Illuminate\Database\QueryException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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

     * @return \Illuminate\Http\Response

     */

    public function render($request, Exception $e)
    {
        $url = $request->url();
        if(apiStrContains($url, '/api')) {
            $message = $e->getMessage();
            if($e instanceof MethodNotAllowedHttpException) {
                $header = $e->getHeaders()['Allow'];
                $header = explode(',', $header)[0];
                $message = 'Please send '.$header.' request.';
            }
            elseif(
                $e instanceof NotFoundHttpException ||
                $e instanceof InvalidArgumentException
            ) {
                $message = 'API not found';
            }
            else if($e instanceof UnauthorizedHttpException) {
                $message = 'Login authenication failed';
            }
            elseif (
                $e instanceof BadMethodCallException ||
                $e instanceof FatalThrowableError ||
                $e instanceof QueryException
            ) {
                $message = $e->getMessage();
            }
            return apiResponse(false, 403, $message);
        }
        return parent::render($request, $e);

    }

}

