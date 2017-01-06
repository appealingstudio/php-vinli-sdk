<?php
/**
 * Created by PhpStorm.
 * User: kwaight
 * Date: 1/5/17
 * Time: 4:05 PM
 */

namespace Vinli;

use GuzzleHttp;

class Client
{

    private $appId;
    private $secretKey;
    private $auth;
    private $guzzleClient;

    public function __construct($appId, $secretKey)
    {
        //Load Config
        $this->appId = $appId;
        $this->secretKey = $secretKey;
        $this->guzzleClient = new GuzzleHttp\Client();

        $this->auth = ['auth' => [ $this->appId, $this->secretKey] ];
    }

    public function getDevices()
    {
        $url = "https://platform.vin.li/api/v1/devices";
        $response = $this->get($url);

        $rawDevices = $response->body->devices;

        $devices = [];
        foreach($rawDevices as $key=>$deviceParams){
            $devices[] = new Device($deviceParams,$this);
        }

        return $devices;
    }

    public function get($url,$params = array()){
        $res = $this->guzzleClient->request("GET", $url, array_merge($this->auth, ['query'=>$params]));
        $response = new Response(json_decode($res->getBody()),$res->getStatusCode());
        return $response;
    }
}
