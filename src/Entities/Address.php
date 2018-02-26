<?php

namespace Hbliang\ShippingManager\Entities;


class Address
{
    protected $id;
    
    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var int
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $country;

    protected $isValid;

    public static function factory(array $values)
    {
        $address = new self();
        if (isset($values['street'])) {
            $address->setStreet($values['street']);
        }
        if (isset($values['city'])) {
            $address->setCity($values['city']);
        }
        if (isset($values['state'])) {
            $address->setState($values['state']);
        }
        if (isset($values['postalCode'])) {
            $address->setPostalCode($values['postalCode']);
        }
        if (isset($values['country'])) {
            $address->setCountry($values['country']);
        }
        
        $address->id = md5(implode('', $values));
        
        return $address;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId()
    {
        return $this->id;   
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function isValid()
    {
        return $this->isValid === true;
    }

    public function setValid()
    {
        $this->isValid = true;
    }

    public function setInvalid()
    {
        $this->isValid = false;
    }
}