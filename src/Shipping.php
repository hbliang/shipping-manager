<?php


namespace Hbliang\ShippingManager;


use Illuminate\Support\Facades\Facade;

class Shipping extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShippingManager::class;
    }
}