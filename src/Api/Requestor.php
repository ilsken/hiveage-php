<?php namespace Bouncefirst\Hiveage\Api;

use Exception;
use GuzzleHttp\ClientInterface;

class Requestor
{
    const PROTOCOL = 'https://';
    const API = '.hiveage.com/api/';
    private $base;
	private $http;

	public function __construct(ClientInterface $http, $username)
	{
        $this->base = self::PROTOCOL . $username . self::API;
		$this->http = $http;
        $this->http->setDefaultOption('base_url', $this->base);
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

    public function getBaseUrl()
    {
        return $this->base;
    }

    public function getHttp()
    {
        return $this->http;
    }
}
