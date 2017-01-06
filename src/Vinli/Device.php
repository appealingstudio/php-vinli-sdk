<?php
/**
 * Created by PhpStorm.
 * User: kwaight
 * Date: 1/5/17
 * Time: 4:05 PM
 */

namespace Vinli;

class Device
{
    private $client;
    private $links;

    public function __construct($deviceParams,$client){

        $this->client = $client;

        foreach($deviceParams as $key=>$param){
            $this->$key = $param;
        }
    }

    public function getVehicles(){
        $url = "https://platform.vin.li/api/v1/devices/".$this->id."/vehicles";

        $response = $this->client->get($url);

        $rawVehicles = $response->body->vehicles;

        $vehicles = [];
        foreach($rawVehicles as $key=>$vehicleParams){
            $vehicles[] = new Device($vehicleParams,$this->client);
        }

        return $vehicles;
    }

    public function getSnapshots($fields = array()){
        $url = "https://telemetry.vin.li/api/v1/devices/".$this->id."/snapshots";

        $response = $this->client->get($url,['fields' => implode(",",$fields)]);

        return $response->body->snapshots;
    }
}