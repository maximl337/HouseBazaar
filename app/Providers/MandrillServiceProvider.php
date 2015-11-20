<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Mandrill;
use App\Contracts\Mail;
use App\Services\MandrillService;

class MandrillServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Mail::class, function ($app) {

            return new MandrillService (
                new Mandrill(env('MANDRILL_SECRET'))
            );
        });
    }
}
