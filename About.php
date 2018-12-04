<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include_once 'lib/CurlHelper.php';
include_once 'lib/Interoperability.php';
include_once 'lib/UrlHelper.php';
include_once 'lib/Product.php';

session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
$_SESSION['IS_SHOPPING_PAGE'] = false;

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
    <h2>About Team Alpha</h2>
    <div class="clearFix">
      <div class="col floatLeft"> <img src="images/icon-stats.png" alt="" class="icon">
        <h3>Worldwide Marketing</h3>
        <p>Team alpha market was found in 2018 including customer all over the world. Product diversity, it includes coffe beans, flowers, spectacular voyages, cryptocoins, Chinese food.</p>
        <p>Team Alpha Market guarantees customer satisfaction with every purchase. Customers who are not fully satisfied may return their product or service for a full refund subject to the terms and conditions of the Team Alpha Marketplace, and the Team Alpha Market Affiliates. These terms and conditions will be presented using impossibly complex legal terms full of conditions and exclusions, all in a document with a font size so small that you will need an electron microscope to read them.</p>
      </div>
    </div>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
