<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/18/18
 * Time: 8:13 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'lib/User.php';
include_once 'lib/DBHelper.php';


$dbh = new DBHelper();

$uToken = $_GET["userToken"];

error_log("Read user for token: ".$uToken);

$user = User::fromToken($uToken);

error_log($user->toString());

$ret = array();

if($user == null)
{
    array_push($ret, "Invalid user token: ".$uToken);
}
else
{
    array_push($ret, $user->toArray());
}

// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($ret);
