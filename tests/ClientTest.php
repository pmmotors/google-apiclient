<?php

namespace PmMotors\Google\tests;

use Mockery;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testClientGetter()
    {
        $client = Mockery::mock('PmMotors\Google\Client', [[]])->makePartial();

        $this->assertInstanceOf('Google_Client', $client->getClient());
    }

    public function testServiceMake()
    {
        $client = Mockery::mock('PmMotors\Google\Client', [[]])->makePartial();

        $this->assertInstanceOf('Google_Service_Storage', $client->make('storage'));
    }

    public function testServiceMakeException()
    {
        $client = Mockery::mock('PmMotors\Google\Client', [[]])->makePartial();

        $this->setExpectedException('PmMotors\Google\Exceptions\UnknownServiceException');

        $client->make('storag');
    }

    public function testMagicMethodException()
    {
        $client = new \PmMotors\Google\Client([]);

        $this->setExpectedException('BadMethodCallException');

        $client->getAuthTest();
    }

    public function testNoCredentials()
    {
        $client = new \PmMotors\Google\Client([]);

        $this->assertFalse($client->isUsingApplicationDefaultCredentials());
    }

    public function testDefaultCredentials()
    {
        $client = new \PmMotors\Google\Client([
            'service' => [
                'enable' => true,
                'file'   => __DIR__.'/data/test.json',
            ],
        ]);

        $this->assertTrue($client->isUsingApplicationDefaultCredentials());
    }
}
