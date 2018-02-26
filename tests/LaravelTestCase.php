<?php


namespace Hbliang\ShippingManager\Tests;


use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase;

class LaravelTestCase extends TestCase
{
    protected function resolveApplicationConfiguration($app)
    {
        (new Dotenv(__DIR__ . '/../', '.env.testing'))->load();

        parent::resolveApplicationConfiguration($app);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('shippingManager', include __DIR__ . '/../config/shippingManager.php');
    }

    protected function getPackageProviders($app)
    {
        $app->register(\Hbliang\ShippingManager\ServiceProvider::class);
        return [\Hbliang\ShippingManager\ServiceProvider::class];
    }
}
