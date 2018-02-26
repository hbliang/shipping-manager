<?php

namespace Hbliang\ShippingManager\Carriers\FedEx\Services\Address;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['address'] = function($app) {
            $wsdl = $app['wsdlPath'] . '/AddressValidationService_v4.wsdl';

            $soapClient = new \SoapClient($wsdl);
            $soapClient->__setLocation($app->getEndPoint('addressvalidation'));

            return new Address($app, $soapClient);
        };
    }
}