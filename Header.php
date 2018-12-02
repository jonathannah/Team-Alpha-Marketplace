
<?php
include_once "lib/Cookies.php";
include_once 'lib/DBHelper.php';
include_once 'lib/User.php';
$dbh_hdr = new DBHelper();

?>


<div id="id01" class="modal">

    <form class="modal-content animate" action="Login2.php">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="images/TeamAlpha.png"  alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <input type="text" placeholder="Enter Username" name="uname" required>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <button type="submit">Login</button>
        </div>
        <div class="container">
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>

<div class="form-popup" id="loginForm" align="center" >
    <form action="Login2.php"  class="form-container">
        <h1>Login</h1>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <input type="submit" class="btn" value="Login">
        <input type="button" class="btn cancel" onclick="closeLoginForm()" value="Close">
    </form>
</div>


<script>
    function openLoginForm() {
        document.getElementById("loginForm").style.display = "block";
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

<div class="form-popup" id="createAccountForm" align="center" width="30%">
    <form action="CreateAccount.php" method="post" class="form-container" >
        <h2>Sign up</h2>
        <myDiv>
            <input type="text" id="firstName" name="firstName" placeholder="first name" style="margin-right: 5px"/>
            <input type="text" id="lastName" name="lastName" placeholder="last name"/>
        </myDiv>
        <myDiv>
            <input type="text" id="email" name="email" placeholder="email"/>
        </myDiv>
        <myDiv>
            <input type="text" id="addr" name="addr" placeholder="address"  style="margin-right: 5px"/>  
        </myDiv>
        <myDiv>
            <input type="text" id="apt" name="apt" placeholder="apt" style="width: 15%"/>
            <input type="text" id="city" name="city" placeholder="city"  style="margin-right: 5px; width: 20%;"/>
            <input type="text" id="state" name="state" placeholder="state" style="width: 10%"/>
            <input type="text" id="zip" name="zip" placeholder="zipcode" style="margin-left: 5px; width: 20%;"/>
        </myDiv>
        <myDiv>
            <input type="text" id="phone" name="phone" placeholder="home phone"  style="margin-right: 5px"/>
            <input type="text" id="cellPhone" name="cellPhone" placeholder="cell phone"/>
        </myDiv>
        <myDiv>
            <input type="text" id="psw" name="psw" placeholder="password"  style="margin-right: 5px"/>
            <input type="text" id="psw_c" name="psw_c" placeholder="re-enter password"/>
        </myDiv>
        <br>

        <input type="submit" class="btn" value="Create Account">
        <input type="button" class="btn cancel" onclick="closeCreateAccountForm()" value="Close">
    </form>
</div>


<script>
    function openCreateAccountForm() {
        document.getElementById("createAccountForm").style.display = "flex";
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
          <li class="active"> <a href="TeamAlpha.php">Team</a> </li>
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
                        <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
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
      <a href="InteropShop.php" class="button">Shop</a> </div>
  </div>
</div>
<!-- / #intro -->
<hr>

<?php
    $dbh_hdr->close();
?>

<div style="clear: both"><br></div>

