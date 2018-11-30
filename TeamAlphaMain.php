

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
    <link href="css/TeamAlpha_style.css" rel="stylesheet" type="text/css">
    <link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">

    <link href="css/StarRating.css" rel="stylesheet" type="text/css">

</head>

<body>
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

        session_start();
        $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];

         session_write_close();

        $dbh = new DBHelper();

        $userServers = TeamEndPoints::$userServers;

    ?>



    <div class="wrapperContainer">
        <?php include 'Header.php'; ?>
    </div>
    <div>
        <nav class="secondary_header" id="menu">
            <ul>
                <li><a class="nav" href="InteropShop.php">Shop</li>
             </ul>
        </nav>
    </div>
    <div>&nbsp;</div>

     <div class="row">
        <h2>Hot products at Team Alpha Market</h2>
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
                $curProduct = Product::fromJSON($products[0]);
                $topProducts[$curUsrv->name] = $curProduct;
            }

        }
        ?>
    <div class="infiniteContainer">
    <?php

        foreach ($topProducts as $curProduct){
            $prodUrl = UrlHelper::addparameterIfSet($curProduct->clickTo, URL_PARAM_UTOKEN, User::currentToken());
            $prodUrl = urlencode($prodUrl);

            $siteUrl = urlencode($curUsrv->baseUrl);

            $thumbnail = $curProduct->thumbnail;
            $mtkProductMap[$curProduct->name] = $prodUrl;
            $avgRating = $curProduct->averageRating * 20;

            $ratingUrl = "#";

            if(User::currentToken() != null){
                $ratingUrl = urlencode($curUsrv->getRateProductUrl($curProduct->productCode, User::currentToken()));
            }
            ?>
            <div class="infiniteCell">
                <div>
                    <a href="CallData.php?calltype=rateProduct&productCode=<?php echo $curProduct->productCode;?>&siteUrl=<?php echo $siteUrl;?>&callto=<?php echo $ratingUrl;?>"  title="Rate this product">
                        <div class="star-ratings-css" style="margin-bottom: 10px; width: 135px">
                            <div class="star-ratings-css-top" style="width: <?php echo $avgRating;?>%">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
                    </a>
                    <a href= "CallData.php?calltype=viewProduct&productCode=<?php echo $curProduct->productCode;?>&siteUrl=<?php echo $siteUrl;?>&callto=<?php echo $prodUrl; ?>">
                        <span class="data"> <img src="<?php echo $thumbnail; ?>" alt="<?php $curProduct->name ?>" style="width:200px"></span>
                        <span class="data"> <h3><?php echo $curProduct->name ?></h3></span>
                    </a>
                </div>
            </div>
            <?php
        }

    ?>
    </div>

    <div></div>


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
                <h2>Popular at <?php echo $curUsrv->name; ?></h2>
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

                    $ratingUrl = "#";

                    if(User::currentToken() != null){
                        $ratingUrl = urlencode($curUsrv->getRateProductUrl($curProduct->productCode, User::currentToken()));
                    }
                    ?>
                    <div class="infiniteCell">
                        <div>
                            <a href="CallData.php?calltype=rateProduct&productCode=<?php echo $curProduct->productCode;?>&siteUrl=<?php echo $siteUrl;?>&callto=<?php echo $ratingUrl;?>"  title="Rate this product">
                                <div class="star-ratings-css" style="margin-bottom: 10px; width: 135px">
                                    <div class="star-ratings-css-top" style="width: <?php echo $avgRating;?>%">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                </div>
                            </a>
                            <a href= "CallData.php?calltype=viewProduct&productCode=<?php echo $curProduct->productCode;?>&siteUrl=<?php echo $siteUrl;?>&callto=<?php echo $prodUrl; ?>">
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

    <?php

        $dbh->close();
    ?>
</body>
</html>


