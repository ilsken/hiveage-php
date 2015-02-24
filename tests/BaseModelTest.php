<?php

class BaseModelTest extends PHPUnit_Framework_TestCase
{
    public function testConstructionWithArray()
    {
        $base = $this->getMock('Bouncefirst\Hiveage\Models\Base', ['getAttributes'], [['test' => 'hello']]);
        $base->expects($this->any())->method('getAttributes')->willReturnArgument(0);
        $this->assertEquals('hello', $base->test);
    }

    public function testConstructionWithNonArray()
    {
        $base = $this->getMock('Bouncefirst\Hiveage\Models\Base', ['getAttributes'], ['test']);
        $base->expects($this->any())->method('getAttributes')->willReturnArgument(0);
        $this->assertNull($base->test);
    }

    public function testSetRequestor()
    {
        $http = $this->getMock('GuzzleHttp\ClientInterface');
        $requestor = $this->getMock('Bouncefirst\Hiveage\Api\Requestor', [], [$http]);
        $base = $this->getMock('Bouncefirst\Hiveage\Models\Base');
        $base->setRequestor($requestor);
    }
}