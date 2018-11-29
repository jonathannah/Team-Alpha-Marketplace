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
$callType = $_GET["calltype"];
$site = $_GET["siteUrl"];

if($user != null || $callType != "rateProduct") {
    if($user == null){
        $userId = "anonymous";
    }
    else{
        $userId = $user->email;
    }

    $safeUrl = urlencode($site);
    $query = "INSERT INTO TeamAlphaMarket.ActivityTracking (userId, site, type) VALUES ('$userId', '$safeUrl', '$callType')";


    error_log($query);

    $dbh = new DBHelper();
    $dbh->query($query);
    $hdr = "Location: $callToUrl";
    header($hdr);
}
?>

<!DOCTYPE html>
<html>
<body>
<div><h1>You must be logged in to use this feature</h1></div>
</body>
</html>


