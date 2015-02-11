<?php namespace Bouncefirst\Hiveage;

use Bouncefirst\Hiveage\Api\Requestor;
use Bouncefirst\Hiveage\Models\Connection;

class Hiveage
{
    private $requestor;

	public function __construct($orgName, $apiKey = '')
	{
        if (is_a($orgName, 'Bouncefirst\Hiveage\Api\Requestor')) {
            $this->requestor = $orgName;
            return;
        }

        $requestor = new Requestor($orgName);
        $requestor->setKey($apiKey);
        $this->requestor = $requestor;
	}

    public function getConnections()
    {
        $model = new Connection;
        $model->setRequestor($this->requestor);
        return $model->all();
    }
}
