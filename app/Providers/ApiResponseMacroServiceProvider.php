<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('outputOk', function ($result="") {
            if($result==""){
                return Response::json([
                    "ok"=>true
                ], 200);
            } else {
                return Response::json([
                    "ok"=>true,
                    "data"=>$result
                ], 200);
            }
        });
        Response::macro('outputError', function ($error="",$http_code=400) {
                return Response::json([
                    "ok"=>false,
				    "error"=>$error,
                ],$http_code);
            });
    }
}
