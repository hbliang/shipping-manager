<?php


namespace Hbliang\ShippingManager;


use Illuminate\Contracts\Foundation\Application;
use Hbliang\ShippingManager\Carriers\FedEx\FedEx;

class ShippingManager
{
    /**
     * @var Application
     */
    protected $app;

    protected $config;

    /**
     * @var CarrierAbstract
     */
    protected $carrier;

    protected $carriers = [
        'FedEx' => FedEx::class,
    ];

    protected $resolvedCarriers = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->config = $app['config']['shippingManager'];
    }

    public function setCarrier($carrierName)
    {
        $carrier = $this->resolveCarrier($carrierName);

        $this->carrier = $carrier;
    }

    /**
     * @return CarrierAbstract
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    public function setDefaultCarrier()
    {
        $this->setCarrier($this->config['default']);
    }

    protected function resolveCarrier($carrierName)
    {
        if (!isset($this->resolvedCarriers[$carrierName])) {
            $this->resolvedCarriers[$carrierName] = new $this->carriers[$carrierName]($this->config[$carrierName]);
        }
        return $this->resolvedCarriers[$carrierName];
    }

    public function validateAddresses($addresses)
    {
        return $this->carrier->validateAddresses($addresses);
    }
}