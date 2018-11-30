<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/9/18
 * Time: 10:46 PM
 */

include_once "DBHelper.php";
include_once 'Cookies.php';

define('URL_PARAM_UTOKEN',"userToken");

class User
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $group;
    public $address;
    public $apt;
    public $city;
    public $state;
    public $zipCode;
    public $cellPhone;
    public $homePhone;

    public static function fromQuery($uid)
    {
        $dbh = new DBHelper();
        $query = "SELECT * FROM  User WHERE LOWER(emailAddress) = LOWER('$uid')";
        //error_log($query);
        $result = $dbh->query($query);

        $row = mysqli_fetch_array($result);
        $dbh->close();

        if($row != null) {
            return self::fromRow($row);
        }

        error_log("No user for uid: ".$uid);
        return null;
    }

    public static function fromRow($row)
    {
        //error_log(print_r($row,true));
        $user = new User();

        $user->fname = $row["firstName"];
        $user->lname = $row["lastName"];
        $user->email = $row["emailAddress"];
        $user->password = $row["password"];

        $user->address = $row['streetAddress'];
        $user->apt = $row['apt'];
        $user->city = $row['city'];
        $user->state = $row['state'];
        $user->zipCode = $row['zipCode'];
        $user->cellPhone = $row['cellPhone'];
        $user->homePhone = $row['homePhone'];
        $user->group = $row["groupID"];

        return $user;
    }

    static function fromToken($token){
        //error_log("User::fromToken(".$token.")");
        $dbh = new DBHelper();
        $query = "SELECT userId FROM UserSession WHERE sessionID = $token";
        $result = $dbh->query($query);

        if($result->num_rows > 0){
            $uRec = mysqli_fetch_array($result);
            $uId = $uRec["userId"];
            //error_log("UID: ".$uId);
            return self::fromQuery($uId);
        }

        //error_log("No user found for: ".$token);
        return null;
    }

    function toArray()
    {
        $ret = array();

        $ret["firstName"] = $this->fname;
        $ret["lastName"] = $this->lname;
        $ret["emailAddress"] = $this->email;
        $ret["password"] = $this->password; // need to use a SHA
        $ret["streetAddress"] = $this->address;
        $ret["apt"] = $this->apt;

        $ret["city"] = $this->city;
        $ret["state"] = $this->state;
        $ret["zipCode"] = $this->zipCode;
        $ret["homePhone"] = $this->homePhone;
        $ret["cellPhone"] = $this->cellPhone;
        $ret["groupID"] = $this->group;

        return $ret;
    }

    static function currentToken()
    {
        if (isset($_COOKIE[COOKIE_USER_TOKEN])) {
            //error_log("\$_COOKIE[".COOKIE_USER_TOKEN."] = ".$_COOKIE[COOKIE_USER_TOKEN]);
            return $_COOKIE[COOKIE_USER_TOKEN];
        }

        return null;
    }

    static function setCookie($userToken)
    {
        setcookie(COOKIE_USER_TOKEN, $userToken, time() + (86400 * 30), "/");
    }

    static function fromCookie()
    {
        $uToken = self::currentToken();
        if ($uToken != null) {
             return self::fromToken($uToken);
        }

        return null;
    }

    static function  clearCookie()
    {
        session_start();


        setcookie(COOKIE_USER_TOKEN, "", 0, "/");
        $_COOKIE[COOKIE_USER_TOKEN] = "";
        session_write_close();
    }

    public function toString()
    {
        $ret = "User: ".$this->fname.", ".$this->lname.": ".$this->email;
        return $ret;
    }

}