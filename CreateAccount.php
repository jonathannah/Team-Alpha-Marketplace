<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/20/18
 * Time: 8:51 PM
 */

include 'lib/DBHelper.php';
include 'lib/Cookies.php';

session_start();

$dbh = new DBHelper();

$msg = "hmmm!";

if(isset($_POST['email']) AND isset($_POST['psw'])) {
    $query = "SELECT firstName, lastName, emailAddress, groupID, password FROM TeamAlphaMarket.User WHERE emailAddress='{$_POST['email']}' ";
    $result = $dbh->query($query) or die("The email or password you entered is not valid");

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $pwd = $_POST['psw'];
    $cpwd = $_POST['psw_c'];
    $addr = $_POST['addr'];
    $apt = $_POST['apt'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $cellPhone = $_POST['cellPhone'];

    $row = mysqli_fetch_array($result);

    $ref = $_SESSION['ref'];
    $pathParts = explode("/", $ref);
    $page = end($pathParts);


    if($row == null && $pwd == $cpwd)
    {
        $add =   "INSERT INTO TeamAlphaMarket.User (firstName, lastName, emailAddress, streetAddress, apt, city, state, zipCode, homePhone, cellPhone, groupID, password)";
        $values = "VALUES('$fname', '$lname', '$email', '$addr', '$apt', '$city', '$state', '$zip', '$phone', '$cellPhone', 'Customer', '$pwd')";

        $query = $add." ".$values;
        error_log($query);
        $dbh->query($query);
        $hdr = "Location: $page";
        header($hdr);
    }
    else if($pwd != $cpwd)
    {
        $msg = "Passwords do not match";
    }
    else
    {
        $msg = "Account already exists";
        $msg = "Account already exists";
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>


</head>
<body >

    <?php echo($page); ?>
    <?php echo($msg); ?>
</body>
</html>

<?php
//Step 4
$dbh->close();
?>

