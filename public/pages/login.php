<?php include_once("../includes/header.php")?>
<section class="parent">
  <section class="child">
    <?php

    if(isset($_SESSION['username'])) {
      redirect();
      exit;
    }

      if (!func::checkLoginState($dbh)) {

        if (isset($_POST['username']) && isset($_POST['password'])) {

          $query = "SELECT * FROM users WHERE user_username = :username AND user_password = :password";

          $username = $_POST['username'];
          $password = $_POST['password'];

          $stmt = $dbh->prepare($query);
          $stmt->execute(array(':username' => $username, ':password' => $password));

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($row['user_id'] > 0) {
            func::createRecord($dbh, $row['user_id'], $row['user_username']);
            header("location:../index.php");

            echo func::createString(32);
          }

      }
        else {

          echo '
            <div id="login">
            <i style="font-size: 10em; padding: 15px 15px 0px 15px; color: #464d51;"class="material-icons">account_circle</i>
            <div id="login-panel">
            <p style="padding: 0px; margin: 0px;">Member Login</p>

            <form autocomplete="off" method="post">
              <label>Username</label></br>
              <input style="font-size: 16px" placeholder="Username" maxlength="40" type="text"  id="username" name="username"/> <br/>
              <label>Password</label><br/>
              <input style="font-size: 16px" placeholder="Password" type="password" id="password" name="password"/></br>
              <input id="login_button" type="submit" maxlength="50" value="login"/>

              <div id="remember_me_checkbox">
              <input type="checkbox" name="remember" value="checked"><l>Remember Me</l>
              </div>
              <div id="forgot_password"><div><a><i>Forgot Password?</i></a></div></div>
            </form>
            </div>

            </div>
          ';
          }
      }


    ?>
</section>
</section>

<?php include_once("../includes/footer.php"); ?>
