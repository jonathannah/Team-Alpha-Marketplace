<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/10/18
 * Time: 9:10 AM
 */

class CurlHelper
{
    public function get($url){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));

        $result = curl_exec($curl);

        curl_close($curl);

        if($result == false)
        {
            error_log("Curl call failed");
            die("Curl call failed");
        }

        return $result;
    }


}