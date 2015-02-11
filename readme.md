#Hiveage.com API

Actual API documentation found here: http://www.hiveage.com/api/

## Installation

Add `"bouncefirst/hiveage": "dev-master"` to your composer.json file, then run `composer update`.


## Usage

You'll want to grab all of your Connections first. Every other model is related to a Connection.

    $hiveage = new \Bouncefirst\Hiveage\Hiveage('bouncefirst', '7FA41818y3wf5q5C739apn');
    $connections = $hiveage->getConnections();
