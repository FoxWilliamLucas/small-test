<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\{Response, ResponseStatus};
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\{
    NotFoundHttpException,
    AccessDeniedHttpException,
    MethodNotAllowedHttpException,
};

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
        $this->renderable(function (MethodNotAllowedHttpException $exception, $request) {
            return Response::respondError(Response::NOT_ALLOWED,ResponseStatus::NOT_ALLOWED);
        });
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            return Response::respondError(Response::NOT_FOUND, ResponseStatus::NOT_FOUND);
        });
        $this->renderable(function (ModelNotFoundException $exception, $request) {
            return Response::respondError(Response::NOT_FOUND, ResponseStatus::NOT_FOUND);
        });
        $this->renderable(function (AccessDeniedHttpException $exception, $request) {
            return Response::respondError(Response::NOT_AUTHORIZED,ResponseStatus::FORBIDDEN);
        });
        $this->renderable(function (AuthenticationException $exception, $request) {
            return Response::respondError(Response::NOT_AUTHENTICATED,ResponseStatus::NETWORK_AUTHENTICATION_REQUIRED);
        });

    }
}
