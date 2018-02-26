<?php

namespace Hbliang\ShippingManager\Carriers\FedEx;


use Hbliang\ShippingManager\CarrierAbstract;

abstract class Client extends \Hbliang\ShippingManager\ClientAbstract
{
    const TEST_ENDPOINT = 'https://wsbeta.fedex.com:443/web-services';
    const PROD_ENDPOINT = 'https://ws.fedex.com:443/web-services';
    
    protected $soapClient;

    protected $requestOptions = [];

    public function __construct(CarrierAbstract $container, \SoapClient $soapClient)
    {
        parent::__construct($container);

        $this->soapClient = $soapClient;

        $this->init();
    }

    protected function init()
    {

    }
    
    protected function wrapRequestOptions($options)
    {
        $options['WebAuthenticationDetail'] = [
            'UserCredential' => [
                'Key' => $this->container['config']['key'],
                'Password' => $this->container['config']['password'],
            ]
        ];

        $options['ClientDetail'] = [
            'AccountNumber' => $this->container['config']['account'],
            'MeterNumber' => $this->container['config']['meter']
        ];
        
        $options['trace'] = 1;

        return array_merge($this->requestOptions, $options);
    }
}