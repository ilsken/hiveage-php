<?php

use Bouncefirst\Hiveage\Api\Requestor;
use GuzzleHttp\Client;

class RequestorTest extends PHPUnit_Framework_TestCase
{
    public function testBaseUrlIsSet()
    {
        $requestor = new Requestor(new Client, 'test');

        $this->assertEquals('https://test.hiveage.com/api/', $requestor->getBaseUrl());
    }

    public function testKeyIsSet()
    {
        $requestor = new Requestor(new Client, 'test');
        $requestor->setKey('1234567890');

        $this->assertEquals($requestor->getHttp()->getDefaultOption('auth'), ['1234567890', '']);
    }

    public function testGetModel()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $client = $this->getMock('GuzzleHttp\ClientInterface');
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $requestor = new Requestor($client, 'test');
        $requestor->getModel('test');
    }

    public function testGetModelFails()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $request->expects($this->once())->method('getBody')->willThrowException(new Exception);
        $client = $this->getMock('GuzzleHttp\ClientInterface');
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $requestor = new Requestor($client, 'test');
        $this->assertFalse($requestor->getModel('test'));
    }
}