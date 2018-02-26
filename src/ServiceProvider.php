<?php


namespace Hbliang\ShippingManager;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(ShippingManager::class, function ($app) {
            $shippingManager = new ShippingManager($app);
            $shippingManager->setDefaultCarrier();

            return $shippingManager;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/shippingManager.php' => config_path('shippingManager.php')
        ]);
    }

    public function provides()
    {
        return [ShippingManager::class];
    }
}