<?php

include 'lib/DBHelper.php';

$dbh = new DBHelper();


?>

<html>

<head>
    <title>User Tracking History</title>
    <!--<link rel="stylesheet" href="css/TeamAlpha_style.css" type="text/css" />-->
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <!--Template-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/print.css" media="print">
    <script src="js/jquery-1.6.4.min.js"></script>
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


        }
    </style>

</head>
<body>
<?php
session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
session_write_close();
?>

<script>
    let lastSortCol = 0;
    let lastSortAscending = false;

    function sortTable(col) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("ProductTable");
        switching = true;
        let ascending = true;

        if(lastSortCol == col)
        {
            ascending = !lastSortAscending;
        }

        lastSortCol = col;
        lastSortAscending = ascending;

        // bubble sort
        while (switching) {
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("td")[col];
                y = rows[i + 1].getElementsByTagName("td")[col];
                //check if the two rows should switch place:

                if(!isNaN(x.innerHTML) )
                {
                    if((ascending && Number(x.innerHTML) > Number(y.innerHTML)) || (!ascending && Number(x.innerHTML) < Number(y.innerHTML))){
                        shouldSwitch = true;
                    }
                }
                else if
                (
                    (ascending && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                    (!ascending && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())
                )
                {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                }

                if(shouldSwitch){
                    break;
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

</script>

<?php
    session_start();
    include 'Header.php';
?>

<div id="content">
  <div class="wrap clearFix">
<div class="row"></div>

<?php


$isAdmin = $_SESSION['admin'];
if(!$isAdmin){ ?>
    <h1> <br><br> You do not have permission to view this page!</h1> <?php
}
else {
    ?>
    <h1 style="color: black">User Activity</h1>

    <?php
    //Step2
    $query = "SELECT id, eventTime, type, userid, site, productCode FROM TeamAlphaMarket.ActivityTracking WHERE 1 ORDER BY id";

    //Step3
    $result = $dbh->query($query);
    $num_fields = mysqli_num_fields($result);
    $fields = mysqli_fetch_fields($result);
    //$row = mysqli_fetch_array($result);
    ?>


    <div><br><br></div>
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
                <td><?php echo $row["userid"]; ?></td>
                <td><?php echo urldecode($row["site"]); ?></td>
                <td><?php echo $row["productCode"]; ?></td>
            </tr>
        <?php } ?>
</table>
</div>
</div>

<?php include 'Footer.php'; ?>

<?php
//Step 4
$dbh->close();
?>



</body>
