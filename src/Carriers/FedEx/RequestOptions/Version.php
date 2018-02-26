<?php

namespace Hbliang\ShippingManager\Carriers\FedEx\RequestOptions;


class Version extends RequestOptionsAbstract
{
    protected $name = 'Version';

    public function setMajor($value)
    {
        $this->values['Major'] = $value;
    }

    public function setServiceId($value)
    {
        $this->values['ServiceId'] = $value;
    }

    public function setIntermediate($value)
    {
        $this->values['Intermediate'] = $value;
    }

    public function setMinor($value)
    {
        $this->values['Minor'] = $value;
    }
}