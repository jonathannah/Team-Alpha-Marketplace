<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/23/18
 * Time: 10:51 AM
 */

class UrlHelper
{
    static public function addparameterIfSet($url, $paramName, $paramVal){
        if(isset($url) && strlen($paramVal) > 0 ){
            return self::addParameter($url, $paramName, $paramVal);
        }

        return $url;
    }
    static public function addParameter($url, $paramName, $paramVal){

        if(parse_url($url, PHP_URL_QUERY)){
            $params = "&".$paramName."=".$paramVal;
        }
        else{
            $params = "?".$paramName."=".$paramVal;
        }

        return $url.$params;
    }

}