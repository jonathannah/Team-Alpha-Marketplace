<?php
include_once 'lib/Cookies.php';
include_once 'lib/DBHelper.php';
include_once 'lib/User.php';

$dbh = new DBHelper();

$uid = htmlspecialchars($_GET["uid"]);
$cust = User::fromQuery($uid);

?>

<html>

<head>
    <!--<link rel="stylesheet" href="css/TeamAlpha_style.css" type="text/css" />-->
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Template-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <script src="js/custom.js"></script>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
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

        <?php
        $isAdmin = $_SESSION['admin'];
        if(!$isAdmin){ ?>
            <h1> <br><br> You do not have permission to view this page!</h1> <?php
        }
        else {
            ?>

            <div>
                <h1 style="color: black"> Customer Info</h1>
                <table>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $cust->fname; ?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $cust->lname; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td> <?php echo $cust->address; ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $cust->city; ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $cust->state; ?></td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td><?php echo $cust->zipCode; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?php echo $cust->homePhone; ?></td>
                    </tr>
                    <tr>
                        <td>Cell Phone Number</td>
                        <td><?php echo $cust->cellPhone; ?></td>
                    </tr>

                </table>

            </div>
            <h1 style="color: black; margin-top: 15px">Activity</h1>

            <?php
                //Step2
                $query = "SELECT id, eventTime, type, site, productCode FROM TeamAlphaMarket.ActivityTracking WHERE userId = '$cust->email' ORDER BY id";

                //Step3
                $result = $dbh->query($query);
                $num_fields = mysqli_num_fields($result);
                $fields = mysqli_fetch_fields($result);
                //$row = mysqli_fetch_array($result);
            ?>


            <div><br></div>
            <div style="position: relative">

                <div style="overflow: auto; height: 30vh">

                    <table id="ProductTable">
                        <tr>
                            <?php for ($i = 0; $i < $num_fields; $i++) { ?>
                                <th>
                                    <?php
                                    echo '<a href="#" onClick="sortTable(', $i, ')">', $fields[$i]->name, '</a>';
                                    ?>
                                </th>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["eventTime"]; ?></td>
                            <td><?php echo $row["type"]; ?></td>
                            <td><?php echo urldecode($row["site"]); ?></td>
                            <td><?php echo $row["productCode"]; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        <?php

        //Step 4
        $dbh->close();
        ?>
    </div>
</div>
</body>
</html>