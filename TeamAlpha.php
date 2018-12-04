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
    <h2>Team Alpha Introduction</h2>
    <div class="clearFix">
      <div class="col floatLeft"> <img src="images/icon-awards.png" alt="" class="icon">
        <a href="http://www.roncabeanz.com"><h3>Roncabeanz</h3></a>
        <p>At Roncabeanz, we love coffee. Not the bitter coffee that most people drink, but fresh coffee made from beans that close to the roast (2 weeks, max). We obsess over the quality and flavor of a great coffee. One with hints of chocolate and fruits, and never bitter.</p>
      </div>
      <div class="col floatRight"> <img src="images/icon-awards.png" alt="" class="icon">
        <a href="http://www.thinkinfullstack.com"><h3>Think Full Stack</h3></a>
        <p>At Air Flower Shop, we make it easy to select beautiful florist-delivered products by investing in the most modern technology, seeking continuous innovation and improvement in services, and providing the best people in the business to ensure your confidence that your order will be placed easily and filled by a Teleflora florist quickly and professionally to your complete satisfaction.</p>
      </div>
    </div>
    <div class="clearFix">
      <div class="col floatLeft"> <img src="images/icon-awards.png" alt="" class="icon">
        <a href="https://www.yarnix.com"><h3>The Whale Products</h3></a>
        <p>The Whale cruise line offers spectacular voyages in style and comfort to outstanding destinations.</p>
      </div>
      <div class="col floatRight"> <img src="images/icon-awards.png" alt="" class="icon">
        <a href="http://www.boostshore.com/wp"><h3>The Crypto Products</h3></a>
        <p>Blockchain-based cryptocurrency whose cryptocoins in circulation are backed by an equivalent amount of traditional fiat currencies, like the dollar, the euro or the Japanese yen, which are held in a designated bank account. Digital currency that offers a high level of anonymity for users and their transactions.</p>
      </div>
    </div>
    <div class="clearFix">
      <div class="col floatLeft"> <img src="images/icon-awards.png" alt="" class="icon">
        <a href="http://www.crazyspartancoder.com//main.html"><h3>The Sichuan Impression</h3></a>
        <p>Sichuan Impression was founded by Yi Lai in 2018 as a Sichuan food restaurant. Today, Sichuan Impression has branches in Japan, the United States, South Korea, Singapore, China, Indonesia, Malaysia, Australia, and Thailand. Sichuan Impression gives people throughout the world the opportunity to experience a classic “taste of Sichuan.”</p>
      </div>
      <div class="col floatRight"> <img src="images/icon-awards.png" alt="" class="icon">
        <a href="http://adiosray.me"><h3>Adiosray</h3></a>
        <p>Adios is a start-up software development education company, with targeting at providing high-quality software developing tutorials and references on web development languages such as HTML, CSS, JavaScript, PHP, SQL, Python, jQuery, and Bootstrap, covering most aspects of web programming.</p>
      </div>
    </div>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
