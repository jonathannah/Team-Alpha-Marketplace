<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/27/18
 * Time: 11:25 PM
 */
include_once 'lib/User.php';
include_once 'lib/DBHelper.php';

$user = User::fromCookie();

$callToUrl = $_GET["callto"];
$callToUrl = urldecode($callToUrl);
$callType = $_GET["calltype"];
$site = $_GET["siteUrl"];
$site = urldecode($site);
$productCode = $_GET["productCode"];

if($user != null || $callType != "rateProduct") {
    if($user == null){
        $userId = "anonymous";
    }
    else{
        $userId = $user->email;
    }

    if($callType == "searchProduct"){
        error_log(basename($_SERVER['REQUEST_URI']));
    }

    $safeUrl = urlencode($site);
    $query = "INSERT INTO TeamAlphaMarket.ActivityTracking (userId, productCode, site, type) VALUES ('$userId', '$productCode', '$safeUrl', '$callType')";


    error_log($query);

    $dbh = new DBHelper();
    $dbh->query($query);
    $hdr = "Location: $callToUrl";
    error_log($hdr);
    header($hdr);
}
?>

<!DOCTYPE html>
<html>
<body>
<div><h1>You must be logged in to use this feature</h1></div>
</body>
</html>


