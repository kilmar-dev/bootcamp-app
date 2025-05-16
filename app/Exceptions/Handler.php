<?php

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Testing\Fakes\ExceptionHandlerFake;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'password',
        'paddword_confirm'
    ];

    public function register():void
    {
        $this->reportable(function(Throwable $e){

        });
    }

    public function render($request, Throwable $exception)
    {
        if($request->expectsJson()){
            if($exception instanceof ModelNotFoundException){
                return response()->json([
                    'status'=>false,
                    'message'=>'Recursos no encontrdo',
                    
                ]);
            }
        }
    }
}