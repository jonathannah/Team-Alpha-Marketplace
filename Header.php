
<?php
include_once "lib/Cookies.php";
include_once 'lib/DBHelper.php';
include_once 'lib/User.php';
$dbh_hdr = new DBHelper();

?>


<div style="text-align: center; margin-bottom: 10px" >
    <div class="form-popup" id="login2">

        <form class="form-container" action="Login2.php"  style="width: 30vw; min-width: 300px">

            <div  style="margin-bottom: 5px; width: 70%">
                <input style="margin-left: 5px" type="text" placeholder="Enter Username" name="uname" required>
                <input style="margin-left: 5px" type="password" placeholder="Enter Password" name="psw" required>
            </div>
            <div class="container" style="width: 70%; alignment: center">
                <button type="submit" style="width: 40%; margin-right: 10px; float: left;">Login</button>
                <button type="button" style="width: 40%; float: left" onclick="document.getElementById('login2').style.display='none'" class="cancelbtn">Cancel</button>
                <span style="float: left; margin-left: 10px" class="psw">Forgot <a href="#">password?</a></span>
            </div>

        </form>
    </div>
</div>

<div style="text-align: center">
    <div class="form-popup" id="loginForm">
        <form action="Login2.php"  class="form-container">
            <h1>Login</h1>

            <input type="text" placeholder="Enter Email" name="email" required>

             <input type="password" placeholder="Enter Password" name="psw" required>

            <input type="submit" class="btn" value="Login">
            <input type="button" class="btn cancel" onclick="closeLoginForm()" value="Close">
        </form>
    </div>
</div>


<script>
    function openLoginForm() {
        document.getElementById("loginForm").style.display = "inline-block";
    }
    function closeLoginForm() {
        document.getElementById("loginForm").style.display = "none";
    }
</script>


<script type="text/javascript">
    function confirmPass() {
        var pass = document.getElementById("psw").value;
        var confPass = document.getElementById("psw_c").value;
        if(pass !== confPass) {
            alert('Wrong confirm password !');
        }
    }
</script>

<div style="text-align: center">
    <div class="form-popup" id="createAccountForm">
        <form action="CreateAccount.php" method="post" class="form-container" style="width: 30vw; min-width: 300px; height: 500px">
            <h2>Sign up for Team Alpha Market Account</h2>
            <div style="margin-top: -10px">
                <div style="float: left; width: 45%; margin-top: -10px">
                    <input type="text" id="firstName" name="firstName" placeholder="first name" style="margin-right: 5px"/>
                </div>
                <div style="float: left; margin-left: 10px; width: 45%; margin-top: -10px">
                    <input type="text" id="lastName" name="lastName" placeholder="last name"/>
                </div>
            </div>
            <div  style="margin-bottom: 5px; clear: both; margin-top: -10px">
                <div style="float: left; width: 92%">
                    <input type="text" id="email" name="email" placeholder="email"/>
                </div>
            </div>
            <div style="margin-bottom: 5px; clear: both">
                <div style="float: left; width: 70%">
                    <input type="text" id="addr" name="addr" placeholder="address"  style="margin-right: 5px"/>
                </div>
                <div style="float: left; margin-left: 10px; width: 20%">
                    <input type="text" id="apt" name="apt" placeholder="apt"/>
                </div>
            </div>
            <div  style="margin-bottom: 5px; clear: both">
                <div style="float: left; width: 50%">
                    <input type="text" id="city" name="city" placeholder="city"  style="margin-right: 5px;"/>
                </div>
                <div style="float: left; margin-left: 10px; width: 15%">
                    <input type="text" id="state" name="state" placeholder="state"/>
                </div>
                <div style="float: left; margin-left: 10px; width: 20%">
                    <input type="text" id="zip" name="zip" placeholder="zipcode" style="margin-left: 5px;"/>
                </div>
            </div >
            <div  style="margin-bottom: 5px; clear: both">
                <div style="float: left; width: 45%">
                    <input type="text" id="phone" name="phone" placeholder="home phone"  style="margin-right: 5px"/>
                </div>
                <div style="float: left; margin-left: 10px; width: 45%">
                    <input type="text" id="cellPhone" name="cellPhone" placeholder="cell phone"/>
                </div>
            </div>
            <div  style="margin-bottom: 20px; clear: both">
                <div style="float: left; width: 45%">
                    <input type="text" id="psw" name="psw" placeholder="password"  style="margin-right: 5px"/>
                </div>
                <div style="float: left; margin-left: 10px; width: 45%">
                    <input type="text" id="psw_c" name="psw_c" placeholder="re-enter password"/>
                </div>
            </div>
            <div  style="clear: both">
                <div style="float: left; ">
                    <input type="submit" class="btn" value="Create Account" style="width: 120px">
                </div>
                <div style="float: right; width: 40%;">
                    <input type="button" class="btn cancel" onclick="closeCreateAccountForm()" value="Cancel" style="width: 100px">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateAccountForm() {
        document.getElementById("createAccountForm").style.display = "inline-block";
    }
    function closeCreateAccountForm() {
        document.getElementById("createAccountForm").style.display = "none";
    }
</script>

<script>
    function handleHelloMenu() {
        openCreateAccountForm();
        var dropdown = document.getElementById("notLoggedInOpts");
        switch(dropdown.value) {
            case 0:
                openLoginForm();
                break;
            case 1:
                openCreateAccountForm();
                break;
        }
    }
</script>

<?php $fileList = get_included_files();?>
<header class="clearFix">
  <div class="wrap"> 
    <a id="logo" href="TeamAlphaMain.php">
          <img class="thumbNail" src="images/TeamAlpha.png" width="160px" height="160px"/>
    </a>
    <hr>
    <nav>
      <div id="nav"> <strong>Navigation</strong>
        <ul>
            <li class="active"> <a href="TeamAlphaMain.php">Home</a> </li>
            <li class="active"> <a href="InteropShop.php">Shop</a> </li>
            <li class="active"> <a href="About.php">About</a> </li>
            <li class="active"> <a href="TeamAlpha.php">Team / Partners</a> </li>
          <?php
            $user = User::fromCookie();

            if($user != null) {
                //error_log($user->toString());
                $isAdmin = $user->group == "Administrator";
                $_SESSION['admin'] = $isAdmin;
                ?>
                <li class="parent">
                    <a href="#">Hello <?php echo $user->fname; ?></a>
                    <ul>
                        <li><a href="LogOff.php">Log Out</a></li>
                        <?php
                            if($isAdmin){
                                echo '<li><a href="ShowCustomers.php">Mangage Customers</a></li>';
                                echo '<li><a href="ShowTracking.php">Show Tracking Information</a></li>';
                            }
                            ?>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="parent">
                    <a href="#">Login / Sign-up</a>
                    <ul>
                        <li><a href="#" onclick="document.getElementById('login2').style.display='inline-block'">Login</a></li>
                        <li><a href="#" onClick="openCreateAccountForm()">Create Account</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
      </div>
    </nav>
  </div>
</header>
<hr>
<div id="intro">
  <div class="inner">
    <div class="wrap clearFix">
      <h1>Team Alpha Market. <strong>Worldwide.</strong></h1>
        <p>
            The best place for shopping!  Team Alpha Market vendors are highly rated, and all
            purchases carry the Team Alpha 100% Satisfaction Guarantee<sup><a href="TAMGarantee.html" style="color: white; text-decoration: none">*</a></sup>.
        </p>
        <?php
        if(!isset($_SESSION['IS_SHOPPING_PAGE']) || $_SESSION['IS_SHOPPING_PAGE'] != true){
        ?>
            <div style="float: left; margin-right: 10vw">
                <a href="InteropShop.php" class="button">Shop</a>
            </div>
        <?php
        }
        ?>
    </div>
  </div>
</div>
<!-- / #intro -->
<hr>

<?php
    $dbh_hdr->close();
?>

<div style="clear: both"><br></div>

