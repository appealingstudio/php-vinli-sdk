<?php
/**
 * @author: Kiefer Waight <kiefer.waight@appealingstudio.com>
 * @package Vinli
 * @version 1.0.0
 * @link http://appealingstudio.com
 */

namespace Vinli;

/**
 * Class Device
 * @package Vinli
 */
class Device extends BaseClass
{
    /**
     * @var string
     */
    protected static $single = "device";

    /**
     * @var string
     */
    protected static $plural = "devices";

    /**
     * Request all vehicles for current device
     *
     * @return array
     */
    public function getVehicles(){
        return $this->getMultipleOfType("https://platform.vin.li/api/v1/devices/".$this->id."/vehicles", "Vehicle");
    }

    /**
     * Request the latest added vehicle for current device
     *
     * @return mixed
     */
    public function getLatestVehicle(){
        return $this->getOfType("https://platform.vin.li/api/v1/devices/" . $this->id . "/vehicles/_latest", "Vehicle");
    }

    /**
     * Requests the latest snapshots for current device
     * Supply a list of fields to select to limit response
     *
     * @param array $fields
     * @return mixed
     */
    public function getSnapshots($fields = array()){
        $url = "https://telemetry.vin.li/api/v1/devices/".$this->id."/snapshots";

        $response = $this->get($url,['fields' => implode(",",$fields)]);

        return $response->body->snapshots;
    }

}