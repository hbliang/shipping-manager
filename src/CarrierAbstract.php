<?php

namespace Hbliang\ShippingManager;


use Pimple\Container;
use Psr\Log\NullLogger;

abstract class CarrierAbstract extends Container
{
    protected $providers = [];

    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($prepends);

        $this->registerConfig($config)
            ->registerProviders()
            ->registerLogger();
    }

    protected function registerConfig(array $config)
    {
        $this['config'] = function () use ($config) {
            return new Config($config);
        };
        return $this;
    }

    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider);
        }
        return $this;
    }

    protected function registerLogger()
    {
        if (isset($this['logger'])) {
            return $this;
        }
        $this['logger'] = new NullLogger();

        return $this;
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @param $address
     * @return array|string
     */
    abstract public function validateAddresses($addresses);
}