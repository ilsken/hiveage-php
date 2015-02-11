<?php namespace Bouncefirst\Hiveage\Api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class Requestor
{
    const PROTOCOL = 'https://';
    const API = '.hiveage.com/api/';
	private $http;
    private $name;

	public function __construct($username, ClientInterface $client = null)
	{
        $this->name = $username;
        if ($client === null) {
            $this->http = new Client(['base_url' => self::PROTOCOL . $this->name . self::API]);
        } else {
            $this->http = $client;
        }
        $this->http->setDefaultOption('verify', false);
        $this->http->setDefaultOption('headers/Accept' , 'application/json');
	}

    public function setKey($key)
    {
        $this->http->setDefaultOption('auth', [$key, '']);
    }

    public function getModel($model)
    {
        try {
            $request = $this->http->createRequest($model);
            return $request->getBody();
        } catch (Exception $exception) {
            return false;
        }
    }

    public function getHttp()
    {
        return $this->http;
    }
}
