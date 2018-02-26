<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2017/11/2
 * Time: 下午12:33
 */

namespace Hbliang\ShippingManager\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Hbliang\ShippingManager\Config;
use Hbliang\ShippingManager\CarrierAbstract;

class CarrierTest extends TestCase
{
    public function testInstance()
    {
        $container = $this->getMockForAbstractClass(CarrierAbstract::class);

        $this->assertInstanceOf(Config::class, $container->config);
        $this->assertInstanceOf(AbstractLogger::class, $container->logger);
    }

    public function testConfig()
    {
        $string = 'string';
        $array = ['array'];

        $config = compact('string', 'array');

        $container = $this->getMockForAbstractClass(CarrierAbstract::class, [$config]);

        $this->assertEquals($string, $container->config->get('string'));
        $this->assertEquals($string, $container['config']['string']);
        $this->assertEquals($array, $container->config->get('array'));
        $this->assertEquals($array, $container['config']['array']);
    }
}
