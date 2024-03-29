<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
        $statusCode  = 400;
        $errors      = [];
        $message     = __('messages.errors.unhandled_exception');
        $messageCode = '';

        if ($exception instanceof AuthorizationException) {
            $message    = __('messages.errors.route_not_found');
            $statusCode = 404;
            $messageCode = 'route.not_found';
        }

        return $request->is('api/*')
            ? response()->json([
                'message' => $message,
                'errors'  => $errors,
                'code'    => $messageCode
            ], $statusCode) : response($message, 400);
    }
}
