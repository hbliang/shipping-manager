<?php

namespace Hbliang\ShippingManager\Carriers\FedEx\Contracts;


interface Rate
{
    public function quote();
}