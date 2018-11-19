<?php

include_once 'lib/User.php';


$returnAddress = htmlspecialchars($_GET["retAddr"]);


$uToken = User::currentToken();

if($returnAddress != "") {
    $hdr = "Location: $returnAddress?userToken=" . $uToken;

    header($hdr);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get Current User Token</title>
</head>
<body>
    <?php echo "User Token: ", $uToken; ?>
</body>
</html>