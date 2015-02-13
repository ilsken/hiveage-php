<?php namespace Bouncefirst\Hiveage;

use Bouncefirst\Hiveage\Api\Requestor;
use Bouncefirst\Hiveage\Models\Bill;
use Bouncefirst\Hiveage\Models\Connection;
use Bouncefirst\Hiveage\Models\Estimate;
use Bouncefirst\Hiveage\Models\Invoice;
use Bouncefirst\Hiveage\Models\Item;
use Bouncefirst\Hiveage\Models\RecurringBill;
use Bouncefirst\Hiveage\Models\RecurringInvoice;
use Bouncefirst\Hiveage\Models\Task;
use Bouncefirst\Hiveage\Models\Time;

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

    public function getEstimates()
    {
        $model = new Estimate;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getBills()
    {
        $model = new Bill;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getInvoices()
    {
        $model = new Invoice;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getItems()
    {
        $model = new Item;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getRecurringBills()
    {
        $model = new RecurringBill;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getRecurringInvoices()
    {
        $model = new RecurringInvoice;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getTasks()
    {
        $model = new Task;
        $model->setRequestor($this->requestor);
        return $model->all();
    }

    public function getTimes()
    {
        $model = new Time();
        $model->setRequestor($this->requestor);
        return $model->all();
    }
}
