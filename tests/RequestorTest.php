<?php

use Bouncefirst\Hiveage\Api\Requestor;

class RequestorTest extends PHPUnit_Framework_TestCase
{
    public function testBaseUrlIsSet()
    {
        $requestor = new Requestor('test');
        $this->assertEquals('https://test.hiveage.com/api/', $requestor->getHttp()->getBaseUrl());
    }

    public function testKeyIsSet()
    {
        $requestor = new Requestor('test');
        $requestor->setKey('1234567890');

        $this->assertEquals($requestor->getHttp()->getDefaultOption('auth'), ['1234567890', '']);
    }

    public function testGetModel()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $client = $this->getMock('GuzzleHttp\ClientInterface');
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $requestor = new Requestor('test', $client);
        $requestor->get('test', ['id' => '12345']);
    }

    public function testGetModelFails()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $request->expects($this->once())->method('getBody')->willThrowException(new Exception);
        $client = $this->getMock('GuzzleHttp\ClientInterface');
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $requestor = new Requestor('test', $client);
        $this->assertFalse($requestor->get('12345', ['id' => '54321']));
    }

    public function testGetModels()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $client = $this->getMock('GuzzleHttp\ClientInterface');
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $requestor = new Requestor('test', $client);
        $requestor->get('test');
    }
}