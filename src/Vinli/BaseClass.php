<?php
/**
 * @author: Kiefer Waight <kiefer.waight@appealingstudio.com>
 * @package Vinli
 * @version 1.0.0
 * @link http://appealingstudio.com
 */

namespace Vinli;

/**
 * Class BaseClass
 * @package Vinli
 */
class BaseClass
{
    /**
     * @var array
     */
    protected $links;

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var array
     */
    protected $auth;

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * BaseClass constructor.
     * @param array $params
     * @param BaseClass $parent
     */
    public function __construct($params,$parent){
        $this->client = $parent->client;
        $this->appId = $parent->appId;
        $this->secretKey = $parent->secretKey;
        $this->auth = $parent->auth;

        foreach($params as $key=>$param){
            $this->$key = $param;
        }
    }

    /**
     * Get wrapper for http requests
     *
     * @param string $url
     * @param array $params
     * @param array $handleBadResponse
     * @return Response
     */
    protected function get($url,$params = array(),$handleBadResponse = array()){
        $res = $this->client->request("GET", $url, array_merge($this->auth, ['http_errors'=>false, 'query'=>$params]));
        $response = new Response($res,$handleBadResponse);
        return $response;
    }

    /**
     * Get request for a single response record of specified type
     *
     * @param string $url
     * @param string $type
     * @return mixed
     */
    protected function getOfType($url, $type){
        $response = $this->get($url);
        $type = __NAMESPACE__ . "\\" . $type;
        $res = $response->body->{$type::$single};
        $record = new $type($res,$this);
        return $record;
    }

    /**
     * Get request for multiple response records of specified type
     *
     * @param string $url
     * @param string $type
     * @return array
     */
    protected function getMultipleOfType($url,$type){
        $response = $this->get($url);

        $type = __NAMESPACE__ . "\\" . $type;

        $rawRecords = $response->body->{$type::$plural};

        $records = [];
        foreach($rawRecords as $key=>$params){
            $records[] = new $type($params,$this);
        }

        return $records;
    }
}