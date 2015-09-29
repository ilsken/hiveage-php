<?php

class HiveageTest extends PHPUnit_Framework_TestCase
{
    public function testRetrieveModels()
    {
        $http = $this->getMock('GuzzleHttp\ClientInterface');
        $methods = ['getConnections', 'getEstimates', 'getBills', 'getInvoices', 'getItems', 'getRecurringBills', 'getRecurringInvoices', 'getTasks', 'getTimes'];
        $requestor = $this->getMock('Bouncefirst\Hiveage\Api\Requestor', [], [$http]);
        $requestor->expects($this->exactly(count($methods)))->method('get');
        $hiveage = new \Bouncefirst\Hiveage\Hiveage($requestor);

        foreach ($methods as $method) {
            $hiveage->$method();
        }
    }

    public function testConstructor()
    {
        $hiveage = new \Bouncefirst\Hiveage\Hiveage('test', '12345');
        $http = $hiveage->getRequestor()->getHttp();
        $this->assertEquals('https://test.hiveage.com/api/', $http->getBaseUrl());
        $this->assertEquals(['12345', ''], $http->getDefaultOption('auth'));
    }
}
