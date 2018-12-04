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
    public $baseUrl;
    public $readProductsUrl;
    public $rateProductUrl;
    public $topFiveUrl;

    public function __construct($name, $baseUrl, $readProductsUrl, $rateProductUrl, $topFiveUrl)
    {
        $this->name = $name;
        $this->baseUrl = $baseUrl;
        $this->readProductsUrl = $readProductsUrl;
        $this->rateProductUrl = $rateProductUrl;
        $this->topFiveUrl = $topFiveUrl;
    }

    public function getRateProductUrl($productCode, $uToken){
        if($this->rateProductUrl != "") {
            return $this->rateProductUrl . "?productCode=$productCode&userToken=$uToken";
        }

        return "#";
    }

    public static $userServers;

    static function init()
    {

        $tmp = array();
        array_push($tmp, new TeamEndPoints
        (
            "Roncabeanz",
            "http://www.roncabeanz.com",
            "http://www.roncabeanz.com/Roncabeanz/ReadProducts.php",
            "http://www.roncabeanz.com/Roncabeanz/RateProduct.php",
            "http://www.roncabeanz.com/Roncabeanz/MostPopularProducts.php?maxProd=5"
        ));
        array_push( $tmp, new TeamEndPoints
        (
            "Think Full Stack",
            "http://www.thinkinfullstack.com",
            "http://www.thinkinfullstack.com/project/api/products.php",
            "",
            "http://www.thinkinfullstack.com/project/api/mostpopular.php?maxProd=5"
        ));
        array_push($tmp, new TeamEndPoints
        (
            "The Whale Products",
            "https://www.yarnix.com",
            "http://yarnix.com/curlproduct/", 
            "",
            "https://yarnix.com/topfiveviewed/"
        ));
        array_push($tmp, new TeamEndPoints
        (
            "The Crypto Products",
            "http://www.boostshore.com/wp",
            "http://www.boostshore.com/wp/curlproduct/",
            "",
            "http://www.boostshore.com/wp/topfive/"
        ));
        array_push($tmp, new TeamEndPoints
        (
            "The Sichuan Impression",
            "http://www.crazyspartancoder.com//main.html",
            "http://www.crazyspartancoder.com/products.php",
            "",
            "http://www.crazyspartancoder.com/mostpopular.php"
        ));

        array_push($tmp, new TeamEndPoints
        (
            "Adiosray",
            "http://adiosray.me",
            "http://adiosray.me/api/product.php",
            "",
            "http://adiosray.me/api/product.php?mostViewed&limit=5"
        ));


        // now arrange in random order
        TeamEndPoints::$userServers = array();

        while(count($tmp) > 0){
            $curSize = count($tmp);
            $cur = rand(0, $curSize - 1);
            array_push(TeamEndPoints::$userServers, $tmp[$cur]);
            unset($tmp[$cur]);
            $tmp = array_values($tmp);
        }
    }
}

TeamEndPoints::init();

