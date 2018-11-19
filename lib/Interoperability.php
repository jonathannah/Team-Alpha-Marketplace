<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/12/18
 * Time: 11:14 PM
 */

class TeamEndPoints
{
    public $name;
    public $requestUrl;

    public function __construct($name, $requestUrl)
    {
        $this->name = $name;
        $this->requestUrl = $requestUrl;
    }
}