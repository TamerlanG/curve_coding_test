<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $base_url = env('EXCHANGE_RATE_API_BASE_URL');

        $this->app->singleton(Client::class, function($api) use ($base_url) {
            return new Client([
                'base_uri' => $base_url,
            ]);
        });
    }
}
