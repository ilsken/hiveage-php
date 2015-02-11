<?php

set_include_path(dirname(__FILE__) . '/../');
require 'vendor/autoload.php';

$http = new GuzzleHttp\Client();

// Replace with your information!
$hiveage = new \Bouncefirst\Hiveage\Hiveage('bouncefirst', '7FA41818y3wf5q5C739apn');
$connections = $hiveage->getConnections();

foreach ($connections as $con) {
    echo $con->id . ' = ' . $con->business_email . PHP_EOL;
}