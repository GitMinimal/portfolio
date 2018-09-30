<?php include_once("../includes/header.php")?>
<?php include_once("../../auth/functions.php")?>

<? $thisPage == "login"; ?>

<div id="page-container">
<?php
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          if (strpos($fullUrl, "login.php?signin=error") == true) {
              echo'
                  <div id="login">
                  <div id="login-panel">
                  <p style="padding: 0px; margin: 0px;">Member Login</p>
                  <div id="login-error"><p style=" color: red; font-size: 15px; visibility: visible">Invalid Login Credentials</p></p></div>
                  <form action="../includes/login_handler.php" autocomplete="off" method="post">
                    <input style="color: red; font-size: 16px" placeholder="Username" maxlength="40" type="text"  id="username" name="username"/> <br/>
                    <input style="color: red; font-size: 16px" placeholder="Password" type="password" id="password" name="password"/></br>
                    <input id="login_button" type="submit" maxlength="50" value="Login" name="Login"/>

                    <div id="remember_me_checkbox">
                    <input type="checkbox" name="remember" value="checked">
                    <l for="rememberme">Remember Me</l>
                    </div>
                    <div id="forgot_password"><div><a><i>Forgot Password?</i></a></div></div>
                  </form>
                  </div>
                  </div>
                ';
              exit();
            }
            else {
              if (strpos($fullUrl, "login.php?signin=successful") == true) {
                header("location: /index.php");
              } else {
              echo'
                  <div id="login">
                  <div id="login-panel">
                  <p style="padding: 0px; margin: 0px;">Member Login</p>
                  <div id="login-error"><p style="font-size: 15px; visibility: hidden"> </p></p></div>
                  <form action="../includes/login_handler.php" autocomplete="off" method="post">
                    <input style="font-size: 16px" placeholder="Username" maxlength="40" type="text"  id="username" name="username"/> <br/>
                    <input style="font-size: 16px" placeholder="Password" type="password" id="password" name="password"/></br>
                    <input id="login_button" type="submit" maxlength="50" value="Login" name="Login"/>

                    <div id="remember_me_checkbox">
                    <input type="checkbox" name="remember" value="checked">
                    <l for="rememberme">Remember Me</l>
                    </div>
                    <div id="forgot_password"><div><a><i>Forgot Password?</i></a></div></div>
                  </form>
                  </div>
                  </div>
                ';
              }
            }
?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/portfolio/public/js/style.js"></script>
</div>
