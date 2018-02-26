<?php

namespace Hbliang\ShippingManager;


abstract class ClientAbstract
{
    /**
     * @var CarrierAbstract
     */
    protected $container;

    public function __construct(CarrierAbstract $container)
    {
        $this->container = $container;
    }
}