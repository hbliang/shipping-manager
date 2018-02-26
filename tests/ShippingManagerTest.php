<?php


namespace Hbliang\ShippingManager\Tests;


use Hbliang\ShippingManager\ShippingManager;

class ShippingManagerTest extends LaravelTestCase
{
    public function testShippingManagerServiceInstance()
    {
        $this->assertNotEmpty($this->app->getProvider(\Hbliang\ShippingManager\ServiceProvider::class));
        $this->assertInstanceOf(ShippingManager::class, $this->app->make(ShippingManager::class));
    }

    public function testValidateAddress()
    {
        $shippingManager = $this->app->make(ShippingManager::class);
        $invalidAddress = \Hbliang\ShippingManager\Entities\Address::factory([
            'street' => '13450 Farmcrest Ct',
            'city' => 'Herndon',
            'state' => 'VA',
            'postalCode' => '201711',
            'country' => 'US',
        ]);

        $validAddress = \Hbliang\ShippingManager\Entities\Address::factory([
            'street' => '437 Baldwin Park Blvd',
            'city' => 'City of Industry',
            'state' => 'CA',
            'postalCode' => '91746',
            'country' => 'US',
        ]);

        $result = $shippingManager->validateAddresses([$validAddress, $invalidAddress]);

        $this->assertNull($result);
        $this->assertTrue($validAddress->isValid());
        $this->assertFalse($invalidAddress->isValid());
    }

    public function testValidateSingleAddress()
    {
        $shippingManager = $this->app->make(ShippingManager::class);

        $validAddress = \Hbliang\ShippingManager\Entities\Address::factory([
            'street' => '437 Baldwin Park Blvd',
            'city' => 'City of Industry',
            'state' => 'CA',
            'postalCode' => '91746',
            'country' => 'US',
        ]);

        $result = $shippingManager->validateAddresses([$validAddress]);

        $this->assertNull($result);
        $this->assertTrue($validAddress->isValid());
    }
}