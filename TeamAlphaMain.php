

<?php
const ROW_COUNT = 7;

include_once 'lib/DBHelper.php';
include_once 'lib/Cookies.php';
include_once 'lib/RecentViews.php';
include_once 'lib/TotalViews.php';
include_once 'lib/Interoperability.php';
include_once 'lib/CurlHelper.php';
include_once 'lib/Product.php';
include_once 'lib/UrlHelper.php';
include_once 'lib/User.php';

session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
$_SESSION['IS_SHOPPING_PAGE'] = false;

session_write_close();

$dbh = new DBHelper();

$userServers = TeamEndPoints::$userServers;

$curUToken = User::currentToken();

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Team Alpha Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    
    <link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
    <!--Replace with the new template
    <link href="css/TeamAlpha_style.css" rel="stylesheet" type="text/css">
    -->
    <link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
    <link href="css/StarRating.css" rel="stylesheet" type="text/css">
    <!--Template-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <script src="js/jquery-1.6.4.min.js"></script>
    <script src="js/custom.js"></script>

    <style>
        .fire {
            animation: burn 1.5s linear infinite alternate;
            -webkit-animation: burn 1.5s linear infinite alternate;
            -moz-animation: burn 1.5s linear infinite alternate;
            -ms-animation: burn 1.5s linear infinite alternate;
        }

        @keyframes burn {
            from { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .4em #ffae34, .2em -.3em .3em #ec760c, -.2em -.4em .4em #cd4606, .1em -.5em .7em #973716, .1em -.7em .7em #451b0e; }
            45%  { text-shadow: .1em -.2em .5em #fefcc9, .15em 0 .4em #feec85, -.1em -.25em .5em #ffae34, .15em -.45em .5em #ec760c, -.1em -.5em .6em #cd4606, 0 -.8em .6em #973716, .2em -1em .8em #451b0e; }
            70%  { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .6em #ffae34, .2em -.3em .4em #ec760c, -.2em -.4em .7em #cd4606, .1em -.5em .7em #973716, .1em -.7em .9em #451b0e; }
            to   { text-shadow: -.1em -.2em .6em #fefcc9, -.15em 0 .6em #feec85, .1em -.25em .6em #ffae34, -.15em -.45em .5em #ec760c, .1em -.5em .6em #cd4606, 0 -.8em .6em #973716, -.2em -1em .8em #451b0e; }
        }

        @-webkit-keyframes burn {
            from { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .4em #ffae34, .2em -.3em .3em #ec760c, -.2em -.4em .4em #cd4606, .1em -.5em .7em #973716, .1em -.7em .7em #451b0e; }
            45%  { text-shadow: .1em -.2em .5em #fefcc9, .15em 0 .4em #feec85, -.1em -.25em .5em #ffae34, .15em -.45em .5em #ec760c, -.1em -.5em .6em #cd4606, 0 -.8em .6em #973716, .2em -1em .8em #451b0e; }
            70%  { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .6em #ffae34, .2em -.3em .4em #ec760c, -.2em -.4em .7em #cd4606, .1em -.5em .7em #973716, .1em -.7em .9em #451b0e; }
            to   { text-shadow: -.1em -.2em .6em #fefcc9, -.15em 0 .6em #feec85, .1em -.25em .6em #ffae34, -.15em -.45em .5em #ec760c, .1em -.5em .6em #cd4606, 0 -.8em .6em #973716, -.2em -1em .8em #451b0e; }
        }

        @-moz-keyframes burn {
            from { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .4em #ffae34, .2em -.3em .3em #ec760c, -.2em -.4em .4em #cd4606, .1em -.5em .7em #973716, .1em -.7em .7em #451b0e; }
            45%  { text-shadow: .1em -.2em .5em #fefcc9, .15em 0 .4em #feec85, -.1em -.25em .5em #ffae34, .15em -.45em .5em #ec760c, -.1em -.5em .6em #cd4606, 0 -.8em .6em #973716, .2em -1em .8em #451b0e; }
            70%  { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .6em #ffae34, .2em -.3em .4em #ec760c, -.2em -.4em .7em #cd4606, .1em -.5em .7em #973716, .1em -.7em .9em #451b0e; }
            to   { text-shadow: -.1em -.2em .6em #fefcc9, -.15em 0 .6em #feec85, .1em -.25em .6em #ffae34, -.15em -.45em .5em #ec760c, .1em -.5em .6em #cd4606, 0 -.8em .6em #973716, -.2em -1em .8em #451b0e; }
        }

        @-ms-keyframes burn {
            from { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .4em #ffae34, .2em -.3em .3em #ec760c, -.2em -.4em .4em #cd4606, .1em -.5em .7em #973716, .1em -.7em .7em #451b0e; }
            45%  { text-shadow: .1em -.2em .5em #fefcc9, .15em 0 .4em #feec85, -.1em -.25em .5em #ffae34, .15em -.45em .5em #ec760c, -.1em -.5em .6em #cd4606, 0 -.8em .6em #973716, .2em -1em .8em #451b0e; }
            70%  { text-shadow: -.1em 0 .3em #fefcc9, .1em -.1em .3em #feec85, -.2em -.2em .6em #ffae34, .2em -.3em .4em #ec760c, -.2em -.4em .7em #cd4606, .1em -.5em .7em #973716, .1em -.7em .9em #451b0e; }
            to   { text-shadow: -.1em -.2em .6em #fefcc9, -.15em 0 .6em #feec85, .1em -.25em .6em #ffae34, -.15em -.45em .5em #ec760c, .1em -.5em .6em #cd4606, 0 -.8em .6em #973716, -.2em -1em .8em #451b0e; }
        }

        .center {
            position: absolute;
            margin: auto;
            top: 50%;
            left: 50%;
            text-align: center;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-family: 'AvenirNext-Heavy', 'Arial Black', sans-serif;
            font-stretch: ultra-condensed;
            font-size: 600%;
            font-size: 12vmin;
            font-weight: 900;
            font-style: italic;
            white-space: nowrap;
            color: black;
            text-decoration: none;
        }

        .center b {
            display: block;
            font-size: 3vh;
            margin-top: -3%;
            padding: 1% 7%;
            font-family: monospace;
            font-weight: normal;
        }

        .center:hover b {
            color: white;
            background-color: black;
        }
    </style>
    
</head>

<body>


    <?php include 'Header.php'; ?>

<div id="content">
  <div class="wrap clearFix">

      <div style="font-size: 3.5vh">
          <em class="fire">Hot Prod</em><em class="fire" style="animation-delay: .2s; -webkit-animation-delay: .2s; -moz-animation-delay: .2s; -ms-animation-delay: .2s;">ucts at </em><em class="fire" style="animation-delay: .4s; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; -ms-animation-delay: .4s;">Team </em><em class="fire" style="animation-delay: .6s; -webkit-animation-delay: .6s; -moz-animation-delay: .6s; -ms-animation-delay: .6s;">Alpha </em><em class="fire" style="animation-delay: 1s; -webkit-animation-delay: 1s; -moz-animation-delay: 1s; -ms-animation-delay: 1s;">Market!</em>
          <b></b>
      </div>

    <?php
        // top products at TAM  This is the most popular product from each site

        $topProducts = array();

        foreach ($userServers as $curUsrv) {
            $ch = new CurlHelper();
            $products = array();

            if($curUsrv->topFiveUrl != null && strlen($curUsrv->topFiveUrl) > 0) {
                $result = $ch->get($curUsrv->topFiveUrl);
                $products = json_decode($result, TRUE);
            }

            if(count($products) > 0){
                $curProductSet = array();

                $curProduct = Product::fromJSON($products[0]);
                $curProductSet["product"] = $curProduct;
                $curProductSet["server"] = $curUsrv;
                $topProducts[$curUsrv->name] =  $curProductSet;
            }

        }
        ?>
    <div class="infiniteContainer">
    <?php

        foreach ($topProducts as $curProductSet){
            $curProduct = $curProductSet["product"];
            $prodUrl = UrlHelper::addparameterIfSet($curProduct->clickTo, URL_PARAM_UTOKEN, User::currentToken());
            $prodUrl = urlencode($prodUrl);

            $siteUrl = $curProductSet["server"]->$baseUrl;

            $thumbnail = $curProduct->thumbnail;
            $mtkProductMap[$curProduct->name] = $prodUrl;
            $avgRating = $curProduct->averageRating * 20;
            $viewProdUrl = "CallData.php?calltype=viewProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=".urlencode($prodUrl);

            $rateProdUrl = "#";

            if($curUToken  != null && $curProductSet["server"]->rateProductUrl != ""){
                $ratingUrl = urlencode($curProductSet["server"]->getRateProductUrl($curProduct->productCode, $curUToken ));
                $rateProdUrl = "CallData.php?calltype=rateProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=$ratingUrl";
                $rateProdText = "Rate this product";
            }
            else{
                $rateProdUrl = $viewProdUrl;
                $rateProdText = "";
            }
            ?>
            <div class="infiniteCell">
                <div>
                    <a href="<?php echo $rateProdUrl;?>"  title="<?php echo $rateProdText;?>">
                        <div class="star-ratings-css" style="margin-bottom: 10px; width: 135px">
                            <div class="star-ratings-css-top" style="width: <?php echo $avgRating;?>%">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
                    </a>
                    <a href= "<?php echo $viewProdUrl;?>">
                        <span class="data"> <img src="<?php echo $thumbnail; ?>" alt="<?php $curProduct->name ?>" style="width:200px"></span>
                        <span class="data"> <h3><?php echo $curProduct->name ?></h3></span>
                    </a>
                </div>
            </div>
            <?php
        }
    ?>
    </div>

     <?php
     // handle per-team popular products

        foreach ($userServers as $curUsrv) {
            $ch = new CurlHelper();
            $products = array();

            if($curUsrv->topFiveUrl != null && strlen($curUsrv->topFiveUrl) > 0) {
                $result = $ch->get($curUsrv->topFiveUrl);
                $products = json_decode($result, TRUE);
            }

            ?>
            <div class="row">
                <h2 style="font-size: 2.5vh; margin-bottom: -10px">Popular at <?php echo $curUsrv->name; ?></h2>
            </div>
            <div class="infiniteContainer">
                <?php

                foreach($products as $curJSONProduct){
                    $curProduct = Product::fromJSON($curJSONProduct);

                    $prodUrl = UrlHelper::addparameterIfSet($curProduct->clickTo, URL_PARAM_UTOKEN, User::currentToken());
                    $prodUrl = urlencode($prodUrl);

                    $siteUrl = urlencode($curUsrv->baseUrl);

                    $thumbnail = $curProduct->thumbnail;
                    $mtkProductMap[$curProduct->name] = $prodUrl;
                    $avgRating = $curProduct->averageRating * 20;

                    $rateProdUrl = "#";
                    $viewProdUrl = "CallData.php?calltype=viewProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=".urlencode($prodUrl);

                    if(User::currentToken() != null && $curUsrv->rateProductUrl != ""){
                        $ratingUrl = urlencode($curUsrv->getRateProductUrl($curProduct->productCode, User::currentToken()));
                        $rateProdUrl = "CallData.php?calltype=rateProduct&productCode=$curProduct->productCode&siteUrl=$siteUrl&callto=$ratingUrl";
                    }
                    else{
                        $rateProdUrl = $viewProdUrl;
                    }
                    ?>
                    <div class="infiniteCell">
                        <div>
                            <a href="<?php echo $rateProdUrl;?>"  title="Rate this product">
                                <div class="star-ratings-css" style="margin-bottom: 10px; width: 135px">
                                    <div class="star-ratings-css-top" style="width: <?php echo $avgRating;?>%">
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
                    </div>
                    <?php
                }   ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include 'Footer.php'; ?>
    <?php

        $dbh->close();
    ?>
</body>
</html>


