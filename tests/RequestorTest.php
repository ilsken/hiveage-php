<?php

use Bouncefirst\Hiveage\Api\Requestor;

class RequestorTest extends PHPUnit_Framework_TestCase
{
    public function testBaseUrlIsSet()
    {
        $http = $this->getMock('GuzzleHttp\Client', null, [Requestor::getApiUrlOption('test')]);
        $requestor = new Requestor($http);
        $this->assertEquals('https://test.hiveage.com/api/', $requestor->getHttp()->getBaseUrl());
    }

    public function testKeyIsSet()
    {
        $http = $this->getMock('GuzzleHttp\Client', null, [Requestor::getApiUrlOption('test')]);
        $requestor = new Requestor($http);
        $requestor->setKey('1234567890');

        $this->assertEquals($requestor->getHttp()->getDefaultOption('auth'), ['1234567890', '']);
    }

    public function testGetModel()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $response = $this->getMock('GuzzleHttp\Message\ResponseInterface');
        $client = $this->getMock('GuzzleHttp\ClientInterface');
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $client->expects($this->once())->method('send')->will($this->returnValue($response));
        $requestor = new Requestor($client);
        $requestor->get('test', ['id' => '12345']);
    }

    public function testGetModelFails()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $response = $this->getMock('GuzzleHttp\Message\ResponseInterface');
        $response->expects($this->once())->method('getBody')->willThrowException(new Exception());
        $client = $this->getMock('GuzzleHttp\ClientInterface', [], Requestor::getApiUrlOption('test'));
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $client->expects($this->once())->method('send')->will($this->returnValue($response));
        $requestor = new Requestor($client);
        $this->assertFalse($requestor->get('12345', ['id' => '54321']));
    }

    /* public function testGetModels()
    {
        $request = $this->getMock('GuzzleHttp\Message\RequestInterface');
        $client = $this->getMock('GuzzleHttp\ClientInterface', [], Requestor::getApiUrlOption('test'));
        $client->expects($this->once())->method('createRequest')->will($this->returnValue($request));
        $requestor = new Requestor($client);
        $requestor->get('test');
    } */

    public function testGetApiUrl()
    {
        $this->assertEquals('https://test.hiveage.com/api/', Requestor::getApiUrl('test'));
    }

    public function testGetApiUrlOption()
    {
        $this->assertEquals(['base_url' => 'https://test.hiveage.com/api/'], Requestor::getApiUrlOption('test'));
    }
}
