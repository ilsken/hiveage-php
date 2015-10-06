#Hiveage.com API

[![Build Status](https://travis-ci.org/Bouncefirst/hiveage-php.svg?branch=master)](https://travis-ci.org/Bouncefirst/hiveage-php)

Actual API documentation found here: http://www.hiveage.com/api/

## Installation

Add `"bouncefirst/hiveage": "dev-master"` to your composer.json file, then run `composer update`.


## Usage

You'll want to grab all of your Connections first. Every other model is related to a Connection.
```php
    $hiveage = new \Bouncefirst\Hiveage\Hiveage('bouncefirst', '7FA41818y3wf5q5C739apn');
    $connections = $hiveage->getConnections();
```

## Sample
```php
set_include_path(dirname(__FILE__).'/../');
require 'vendor/autoload.php';
$http = new GuzzleHttp\Client();
// Replace with your information!
$hiveage = new \Bouncefirst\Hiveage\Hiveage('bouncefirst', '7FA41818y3wf5q5C739apn');
$connections = $hiveage->getConnections();
foreach ($connections as $con) {
    echo $con->id.' = '.$con->business_email.PHP_EOL;
}
```
