<?php

include 'lib/DBHelper.php';
include 'lib/Cookies.php';

session_start();

$dbh = new DBHelper();

$msg = "hmmm!";

$uname = htmlspecialchars($_GET["uname"]);
$upwd = htmlspecialchars($_GET["psw"]);


if(isset($uname) AND isset($upwd)) {
    $query = "SELECT firstName, lastName, emailAddress, groupID, password FROM TeamAlphaMarket.User WHERE LOWER(emailAddress)=LOWER('$uname') ";
    $result = $dbh->query($query);

    $fields = mysqli_fetch_fields($result);

    $row = mysqli_fetch_array($result);
    $pwd = $row["password"];


    if ($upwd == $pwd) {
        $query = "INSERT INTO UserSession (userId) VALUES ('$uname')";
        $dbh->query($query);
        $userToken = $dbh->lastInsertId();
        User::setCookie($userToken);
         //header("Refresh:$secondsWait");
        $msg = "Login successful: ".$uname.", ".$pwd;
    } else {
        $msg = "The email '$uname' or password '$upwd' you entered is not valid pwd ($pwd)";
        error_log("Login Error: ".$msg);
    }
}

    $ref = $_SESSION['ref'];
    $pathParts = explode("/", $ref);
    $page = end($pathParts);
    $hdr = "Location: $page";

    header($hdr);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>

    <script language="JavaScript">
        if($page != null) {
            var time = null

            function move() {

                window.location = "<?php echo $page ?>";

            }
        }
        //-->
    </script>
</head>
<body onload="timer=setTimeout('move()',1)">

    <?php echo($page); ?>
    <?php echo($msg); ?>
</body>
</html>

<?php
//Step 4
$dbh->close();
?>

