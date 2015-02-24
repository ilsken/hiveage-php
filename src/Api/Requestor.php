<?php namespace Bouncefirst\Hiveage\Api;

use Exception;
use GuzzleHttp\ClientInterface;

class Requestor
{
    const PROTOCOL = 'https://';
    const API = '.hiveage.com/api/';
	private $http;

	public function __construct(ClientInterface $client = null)
	{
        $client->setDefaultOption('headers/Accept' , 'application/json');
        $this->http = $client;
	}

    public function setKey($key)
    {
        $this->http->setDefaultOption('auth', [$key, '']);
    }

    public function get($model, $options = [])
    {
        try {
            $request = $this->getHttp()->createRequest('GET', $model, $options);
            $response = $this->getHttp()->send($request);
            return $response->getBody();
        } catch (Exception $exception) {
            return false;
        }
    }

    public function getHttp()
    {
        return $this->http;
    }

    public static function getApiUrl($name)
    {
        return self::PROTOCOL . $name . self::API;
    }

    public static function getApiUrlOption($name, $options = [])
    {
        return array_merge($options, ['base_url' => self::getApiUrl($name)]);
    }
}
