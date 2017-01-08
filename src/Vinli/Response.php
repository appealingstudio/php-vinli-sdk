<?php
/**
 * @author: Kiefer Waight <kiefer.waight@appealingstudio.com>
 * @package Vinli
 * @version 1.0.0
 * @link http://appealingstudio.com
 */

namespace Vinli;


/**
 * Class Response
 * @package Vinli
 */
class Response
{
    /**
     * @var mixed
     */
    public $body;

    /**
     * @var integer
     */
    public $status;

    /**
     * Response constructor.
     * @param $res
     * @param array $handleBadResponse
     * @throws Exception\ClientException
     */
    public function __construct($res, $handleBadResponse = array())
    {
        $this->status = $res->getStatusCode();
        $this->body = json_decode($res->getBody());

        if (!in_array($this->status,$handleBadResponse)) {
            switch ($this->status) {
                case 200:
                    break;
                case 400;
                    throw new Exception\ClientException("400: " . $this->body->message);
                    break;
                case 401:
                    throw new Exception\ClientException("401: " . $this->body->message);
                    break;
                case 404:
                    throw new Exception\ClientException("404: " . $this->body->message);
                    break;
                case 500:
                    throw new Exception\ClientException("500: " . $this->body->message);
                    break;
                default:
                    throw new Exception\ClientException();
                    break;
            }
        }
    }
}