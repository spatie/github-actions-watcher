<?php

namespace App\Providers;

use Illuminate\Http\Client\Response;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Response::macro('map', function(string $key, callable $callable) {
            $response = $this->json()[$key];

            return collect($response)->map($callable);
        });
    }
}
