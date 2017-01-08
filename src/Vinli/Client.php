<?php
/**
 * @author: Kiefer Waight <kiefer.waight@appealingstudio.com>
 * @package Vinli
 * @version 1.0.0
 * @link http://appealingstudio.com
 */

namespace Vinli;

use GuzzleHttp;

/**
 * Class Client
 * @package Vinli
 */
class Client extends BaseClass
{
    /**
     * Client constructor.
     * @param string $appId
     * @param string $secretKey
     */
    public function __construct($appId, $secretKey)
    {
        //Load Config
        $this->appId = $appId;
        $this->secretKey = $secretKey;
        $this->client = new GuzzleHttp\Client();

        $this->auth = ['auth' => [ $this->appId, $this->secretKey] ];
    }

    /**
     * Request all devices for developer account
     *
     * @return array
     */
    public function getDevices()
    {
        $url = "https://platform.vin.li/api/v1/devices";
        $response = $this->get($url);

        $rawRecords = $response->body->devices;

        $records = [];
        foreach($rawRecords as $key=>$params){
            $records[] = new Device($params,$this);
        }

        return $records;
    }

    /**
     * Request a specific device by ID
     *
     * @param string $id
     * @return mixed
     */
    public function getDevice($id){
        return $this->getOfType(
            "https://platform.vin.li/api/v1/devices/".$id,
            "Device"
        );
    }

    /**
     * Request a specific vehicle by ID
     * @param string $id
     * @return mixed
     */
    public function getVehicle($id){
        return $this->getOfType(
            "https://platform.vin.li/api/v1/vehicles/".$id,
            "Vehicle"
        );
    }
}
