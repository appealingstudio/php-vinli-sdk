<?php
/**
 * Tests for get requests that in general should return nothing but a 200 response.
 * Requires at least 1 device, and 1 vehicle associated with developer account.
 *
 * @author: Kiefer Waight <kiefer.waight@appealingstudio.com>
 * @package Vinli
 * @version 1.0.0
 * @link http://appealingstudio.com
 */

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once './config.php';

use Vinli\Client;

//Lets load everything up
$vinli = new Vinli\Client($config['vinli']['id'],$config['vinli']['key']);

//Test Device Requests
$devices = $vinli->getDevices();
$device = $vinli->getDevice($devices[0]->id);

//Test Vehicle Requests
$vehicles = $device->getVehicles();
$latest = $device->getLatestVehicle();
$vehicleSpecifications = $vinli->getVehicle($latest->id);

//Finish
echo "SUCCESS";
//$response = $vehicleSpecifications;
//echo json_encode($response, JSON_PRETTY_PRINT);