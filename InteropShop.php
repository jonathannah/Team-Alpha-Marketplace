<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include_once 'lib/CurlHelper.php';
include_once 'lib/Interoperability.php';

//$siteName = utf8_decode($_GET["feedName"]);
//$siteUri= utf8_decode($_GET["feedUri"]);

session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];

session_write_close();

$userServers = array();

if((isset($siteName) && strlen($siteName) > 0) && (isset($siteUri) && strlen($siteUri) > 0)){
    array_push($userServers, new TeamEndPoints($siteName, $siteUri));
}
else {
    array_push($userServers, new TeamEndPoints("The Beanz Products", "http://roncabeanz.com/Roncabeanz/ReadProducts.php"));
    array_push($userServers, new TeamEndPoints("Think Full Stack Products", "http://www.thinkinfullstack.com/project/apiproducts.php"));
}

$mktProducts = array();
$mtkProductMap = array();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team Alpha Market</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
    <link href="css/Header.css" rel="stylesheet" type="text/css">

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


<div class="row">

</div>


<div class="row">

</div>

<div class="ui-widget">
    <label for="searchProd">Search Our Marketplace: </label>
    <input id="searchProd", placeholder="Search Products", style="width: 25%">
</div>



<?php
//Step2
foreach ($userServers as $cur) {
    $ch = new CurlHelper();
    $result = $ch->get($cur->requestUrl);
    $products = json_decode($result, TRUE);

    ?>

    <div class="row">

    </div>

    <div class="row">
        <h2><?php echo $cur->name; ?></h2>
    </div>


    <!-- Portfolio Gallery Grid -->
    <div class="infiniteContainer">
        <?php
        foreach ($products as $product) {
            $thumbnail = $product["thumbnail"];
            array_push($mktProducts, $product["name"]);
            $mtkProductMap[$product["name"]] = $product["clickTo"];

            ?>
            <div class="infiniteCell">
                <a href= "<?php echo $product["clickTo"]; ?>">
                    <span class="data"> <img src="<?php echo $thumbnail; ?>" alt="<?php $product["name"] ?>" style="width:200px"></span>
                    <span class="data"> <h3><?php echo $product["name"] ?></h3></span>
                </a>
            </div>

            <?php
        }
        ?>
    </div>
    <!-- END MAIN -->
    <?php
}

?>

<script>
    $( function() {
        var availableTags = <?php echo json_encode($mktProducts);?>;
        $( "#searchProd" ).autocomplete({
            source: availableTags
        });
    } );
</script>
<script>
    var input = document.getElementById("searchProd");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            var name = document.getElementById("searchProd").value;
            var prodUrls = <?php echo json_encode($mtkProductMap); ?>;
            var prodUrl = prodUrls[name];
            window.location.href = prodUrl;
        }
    });
</script>
</body>
</html>
