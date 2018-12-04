<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include_once 'lib/CurlHelper.php';
include_once 'lib/Interoperability.php';
include_once 'lib/UrlHelper.php';
include_once 'lib/Product.php';

session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];

session_write_close();

$userServers = TeamEndPoints::$userServers;

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team Alpha Market</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
    <link href="css/Header.css" rel="stylesheet" type="text/css">

    <!--Template-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <script src="js/custom.js"></script>

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
    </style>
</head>
<body>
<?php
    session_start();
    $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
    session_write_close();
?>

<?php include 'Header.php'; ?>

<div id="content">
    <div class="wrap clearFix">
    <h2>Team Alpha Partners</h2>
    <div class="clearFix">
      <div class="col floatLeft"> <img src="images/icon-backup.png" alt="" class="icon">
        <a href=""><h3></h3></a>
        <p></p>
      </div>
      <div class="col floatRight"> <img src="images/icon-backup.png" alt="" class="icon">
        <a href=""><h3></h3></a>
        <p></p>
      </div>
    </div>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
