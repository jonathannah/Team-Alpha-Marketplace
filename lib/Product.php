<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/25/18
 * Time: 6:53 PM
 */

class Product
{
    public $name;
    public $price;
    public $productCode;
    public $averageRating;
    public $viewCount;
    public $thumbnail;
    public $clickTo;
    public $description;

    public static function fromJSON($json)
    {
        $ret = new Product();

        $ret->name = $json["name"];
        $ret->price = $json["price"];
        $ret->productCode = $json["productCode"];
        $ret->averageRating = round(floor(floatval($json["averageRating"]) * 2) /2, 1);

        $ret->viewCount = isset($json["viewCount"]) ? $json["viewCount"] : 0;
        $ret->thumbnail = $json["thumbnail"];
        $ret->clickTo = $json["clickTo"];
        $ret->description = $json["description"];

        return $ret;
    }
}