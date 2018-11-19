

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Team Alpha Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
    <link href="css/TeamAlpha_style.css" rel="stylesheet" type="text/css">
    <link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">


</head>

<body>
<?php
    const ROW_COUNT = 7;

    include_once 'lib/DBHelper.php';
    include_once 'lib/Cookies.php';
    include_once 'lib/RecentViews.php';
    include_once 'lib/TotalViews.php';

    session_start();
    $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];

     session_write_close();

    $dbh = new DBHelper();
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
    <div>
        <h2>Recently Viewed</h2>
        <div class="infiniteContainer">
        </div>
    </div>
<div>

    <h2>Viewed most by ???</h2>
    <div class="infiniteContainer">
    </div>

    <div>
        <h2><br>Trending Products</h2>


    </div>

<?php

        $dbh->close();
    ?>
</body>
</html>


