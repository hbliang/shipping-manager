<?php

namespace Hbliang\ShippingManager\Carriers\FedEx\Contracts;


interface Address
{
    /**
     * @param array $address
     * @return mixed
     */
    public function validate(array $addresses, $options);
}