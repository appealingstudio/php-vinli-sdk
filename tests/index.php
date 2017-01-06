<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Vinli\Client;

//Lets load everything up
$vinli = new Vinli\Client("****","***");
$devices = $vinli->getDevices();

//I only have one device
$myDevice = $devices[0];

//We just want the fuel level and RPMS
$fuelSnapshots = $myDevice->getSnapshots(['fuelLevelInput']);
$rpmSnapshots = $myDevice->getSnapshots(['rpm']);

//Lets just get the lastest snapshots
$fuelLevel = $fuelSnapshots[0]->data->fuelLevelInput;
$rpms = $rpmSnapshots[0]->data->rpms;


