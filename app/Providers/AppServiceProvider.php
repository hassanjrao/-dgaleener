<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $forceHttps = filter_var(
            env('APP_HTTPS', $this->app->environment('production')),
            FILTER_VALIDATE_BOOLEAN
        );

        if ($forceHttps) {
            URL::forceScheme('https');
        }

        \Validator::extend('recaptcha', 'App\Validators\ReCaptcha@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
