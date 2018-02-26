<?php

namespace Hbliang\ShippingManager\Carriers\FedEx;


use Hbliang\ShippingManager\CarrierAbstract;

class FedEx extends CarrierAbstract
{
    protected $providers = [
        \Hbliang\ShippingManager\Carriers\FedEx\Services\Address\ServiceProvider::class,
    ];

    public function __construct(array $config = [], array $prepends = [])
    {
        $this['wsdlPath'] = __DIR__ . '/Resources/wsdl';
        
        parent::__construct($config, $prepends);
    }
    
    public function getEndPoint($uri = '')
    {
        $endpoint = $this['config']['debug'] ? Client::TEST_ENDPOINT : Client::PROD_ENDPOINT;
        
        if ($uri) {
            return trim($endpoint, '/ ') . '/' . rtrim($uri, '/ ');
        }
        
        return $endpoint;
    }

    public function validateAddresses($addresses)
    {
        return $this->address->validate($addresses);
    }
}