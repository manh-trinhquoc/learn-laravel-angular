<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException as MethodNotAllowedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException as JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException as TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException as TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //custom render
    public function render($request, Throwable $exception)
    {
        if (!$request->wantsJson()) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof ModelNotFoundException) { // Enable header Accept: application/json to see the proper error msg
            return response()->json(
                ['error' => 'Resource not found'],
                404
            );
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(
                ['error' => 'Method Not Allowed'],
                405
            );
        }
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json(
                ['error' => 'Token not provided'],
                401
            );
        }
        // JWT Auth related errors
        if ($exception instanceof JWTException) {
            return response()->json(['error' => $exception], 500);
        }
        if ($exception instanceof TokenExpiredException) {
            return response()->json(
                ['error' => 'token_expired'],
                $exception->getStatusCode()
            );
        } elseif ($exception instanceof TokenInvalidException) {
            return response()->json(
                ['error' => 'token_invalid'],
                $exception->getStatusCode()
            );
        }

        return parent::render($request, $exception);
    }
}
