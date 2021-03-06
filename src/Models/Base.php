<?php

namespace Bouncefirst\Hiveage\Models;

use ArrayAccess;
use Bouncefirst\Hiveage\Api\Requestor;

abstract class Base implements ArrayAccess
{
    public $attributes;
    private $requestor;
    protected $name;
    protected $namePlural;
    protected $nameSingular;
    protected $hashKey;
    protected $idType;

    public function __construct($attributes = [])
    {
        $this->setAttributes($attributes);
    }

    protected function setAttributes($attributes)
    {
        if (is_array($attributes)) {
            $this->attributes = $attributes;
        }
    }

    public function getRequestor()
    {
        return $this->requestor;
    }

    public function setRequestor(Requestor $requestor)
    {
        $this->requestor = $requestor;
    }

    public function create()
    {
    }

    public function find($hash = null)
    {
        if (is_null($hash)) {
            if (is_null($this->hashKey)) {
                return;
            }
            $hash = $this->hashKey;
        }

        $class = get_called_class();
        $json = $this->getRequestor()->get($this->name.'/'.$hash);
        $objects = json_decode($json, true);

        if (!is_array($objects)) {
            return;
        }

        $model = $objects[$this->nameSingular];

        return new $class($model);
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        return;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    public function all()
    {
        $class = get_called_class();
        $json = $this->getRequestor()->get($this->name);
        $objects = json_decode($json, true);

        if (!is_array($objects)) {
            return [];
        }

        $models = $objects[$this->namePlural];
        $modelArray = [];

        foreach ($models as $model) {
            $new = new $class($model);
            $new->setRequestor($this->getRequestor());
            $modelArray[] = $new;
        }

        return $modelArray;
    }
}
