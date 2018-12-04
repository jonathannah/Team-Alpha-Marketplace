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

$mktProducts = array();
$mktProductMap = array();

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
    <link href="css/StarRating.css" rel="stylesheet" type="text/css">

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
    $_SESSION['IS_SHOPPING_PAGE'] = true;
    session_write_close();
?>

<?php include 'Header.php'; ?>

<div id="content">
  <div class="wrap clearFix">

<div class="ui-widget">
    <label for="searchProd" style="margin-top: 15px; margin-bottom: 10px">Search Our Marketplace: </label>
    <input id="searchProd", placeholder="Search Products", style="width: 25%"/>
</div>



<?php
//Step2
foreach ($userServers as $curUsrv) {
    $ch = new CurlHelper();
    $result = $ch->get($curUsrv->readProductsUrl);
    $products = json_decode($result, TRUE);

    ?>

    <div class="row">

    </div>

    <div class="row">
        <h2><?php echo $curUsrv->name; ?></h2>
    </div>


    <!-- Portfolio Gallery Grid -->
    <div class="infiniteContainer">
        <?php
        foreach ($products as $curJSONProduct) {
            $curProduct = Product::fromJSON($curJSONProduct);

            $prodUrl = UrlHelper::addparameterIfSet($curProduct->clickTo, URL_PARAM_UTOKEN, User::currentToken());
            $siteUrl = urlencode($curUsrv->baseUrl);
            $searchProdUrl = "CallData.php?calltype=searchProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=".urlencode($prodUrl);
            $viewProdUrl = "CallData.php?calltype=viewProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=".urlencode($prodUrl);
            $thumbnail = $curProduct->thumbnail;
            array_push($mktProducts, $curProduct->name);

            if(strpos($curProduct->name, "Burundi") != false){
                error_log($curProduct->name);
            }
            $mktProductMap[$curProduct->name] = $searchProdUrl;
            $avgRating = $curProduct->averageRating * 20;

            $rateProdUrl = "#";

            if(User::currentToken() != null && $curUsrv->rateProductUrl != ""){
                $ratingUrl = urlencode($curUsrv->getRateProductUrl($curProduct->productCode, User::currentToken()));
                $rateProdUrl = "CallData.php?calltype=rateProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=$ratingUrl";
            }
            else{
                $rateProdUrl = $viewProdUrl;
            }

            ?>
            <div class="infiniteCell">
                <a href="<?php echo $rateProdUrl;?>">
                    <div class="star-ratings-css" style="margin-bottom: 10px">
                        <div class="star-ratings-css-top" style="width: <?php echo$curProduct->averageRating*20;?>%" title="Rate this product">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                </a>
                <a href= "<?php echo $viewProdUrl; ?>">
                     <span class="data"> <img src="<?php echo $thumbnail; ?>" alt="<?php $curProduct->name ?>" style="width:200px"></span>
                    <span class="data"> <h3><?php echo $curProduct->name ?></h3></span>
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

    </div>
</div>

<?php include 'Footer.php'; ?>

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
            var prodUrls = <?php echo json_encode($mktProductMap); ?>;
            var prodUrl = prodUrls[name];
            window.location.href = prodUrl;
        }
    });
</script>
</body>
</html>
