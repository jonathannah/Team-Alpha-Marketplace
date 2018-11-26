<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/1/18
 * Time: 8:11 AM
 */
include_once 'Cookies.php';

define('MAX_VIEWS', 5);

class TotalViews
{
    private $totalViews = array();

    private $viewName = "";

    private function getIndex($productCode)
    {
        return "P_"."$productCode";
    }

    private function fromIndex($index)
    {
        return substr($index, 2);
    }

    private function readCookie()
    {
        if(isset($_COOKIE[$this->viewName])) {
            $this->totalViews = array();
            $cols = explode(';', $_COOKIE[$this->viewName]);

            foreach ($cols as $column) {
                if (strlen($column) > 3){
                    $fields = explode(':', $column);
                    $this->totalViews[$fields[0]] = intval($fields[1]);
                }
            }
        }
    }

    private function writeCookie()
    {
        $ak = array_keys($this->totalViews);
        $av = array_values($this->totalViews);

        $strVal = "";

        for($i = 0; $i<count($ak); ++$i)
        {
            $strVal = $strVal.sprintf( "%s:%d;", $ak[$i], $av[$i]);
        }

        setcookie($this->viewName, $strVal, time() + (86400 * 30), "/");
    }

    function dump()
    {
        $ak = array_keys($this->totalViews);
        $av = array_values($this->totalViews);

        for($i = 0; $i < count($av); ++$i){
            error_log("(Key: ".$ak[$i]." Value: ".$av[$i].") ");
        }
    }

    function __construct()
    {
        $cn = "TeamAlphaMarktUser";
        if(isset($_COOKIE[$cn])) {
            $replace = array(' ', '.');
            $name = str_replace($replace, '_', $_COOKIE[$cn]);
            $this->viewName =  "TeamAlphaMarktTotalViews"."_".$name;
        } else {
            $this->viewName= "TeamAlphaMarktTotalViews"."_";
        }

        $this->readCookie();

     }

    function put($productCode)
    {
        $idx = $this->getIndex($productCode);

        if($this->totalViews[$idx] == null)
        {
            $this->totalViews[$idx] = 0;
        }
        $this->totalViews[$idx] = intval($this->totalViews[$idx]) + 1;

        $this->writeCookie();

    }

    function getValues()
    {
        return $this->totalViews;
    }

    function size()
    {
        return count($this->totalViews);
    }

    function viewName()
    {
        return $this->viewName;
    }

    function topFive()
    {
        arsort($this->totalViews);

        $ret = array();
        $i = 0;
        $ak = array_keys($this->totalViews);
        foreach ($ak as $key)
        {
            $ret[$i] = $this->fromIndex($key);
            if(++$i >= MAX_VIEWS){
                break;
            }

        }
        return $ret;
    }
}