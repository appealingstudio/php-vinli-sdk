<?php
/**
 * Created by PhpStorm.
 * User: kwaight
 * Date: 1/5/17
 * Time: 5:47 PM
 */

namespace Vinli;


class Response
{
    public $body;
    public $status;

    public function __construct($body, $status)
    {
        $this->body = $body;
        $this->status = $status;
    }
}