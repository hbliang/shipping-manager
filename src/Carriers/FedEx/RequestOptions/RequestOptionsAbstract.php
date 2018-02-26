<?php

namespace Hbliang\ShippingManager\Carriers\FedEx\RequestOptions;


abstract class RequestOptionsAbstract
{
    protected $values;

    protected $name;

    public function __construct(array $values = [])
    {
        foreach ($values as $key => $value) {
            $this->values[$key] = $value;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function toArray()
    {
        return $this->values;
    }
}