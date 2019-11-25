<?php

namespace PayWayDev\EasyPayment;

use Illuminate\Support\ServiceProvider;

class EasyPaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->publishes([
            __DIR__.'/Config/mollie.php' => config_path('mollie.php'),
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('PayWayDev\EasyPayment\Controllers\EasyPayTestController');
    }
}
