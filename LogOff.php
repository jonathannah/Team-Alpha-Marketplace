<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/20/18
 * Time: 9:49 PM
 */

include_once 'lib/Cookies.php';
include_once 'lib/User.php';


$ref = $_SESSION['ref'];

User::clearCookie();


$pathParts = explode("/", $ref);
$page = end($pathParts);
$hdr = "Location: $page";

header($hdr);