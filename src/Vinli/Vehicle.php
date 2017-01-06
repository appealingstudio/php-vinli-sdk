<?php
/**
 * Created by PhpStorm.
 * User: kwaight
 * Date: 1/5/17
 * Time: 6:03 PM
 */

namespace Vinli;


class Vehicle
{
    private $client;
    private $links;

    public function __construct($vehicleParams,$client){

        $this->client = $client;

        foreach($vehicleParams as $key=>$param){
            $this->$key = $param;
        }
    }
}