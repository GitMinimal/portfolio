<?php
include_once '../core/header.php';
require_once $_SERVER['DOCUMENT_ROOT']."/portfolio/auth/Auth.php";
require_once $_SERVER['DOCUMENT_ROOT']."/portfolio/auth/Util.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();

require_once $_SERVER['DOCUMENT_ROOT'].'/portfolio/auth/authCookieSessionValidate.php';

//$login_message = '<div style="visibility: hidden; font-size: 16px;">Placeholder</div>';

if ($isLoggedIn) {
  $login_message = '<div style=" color: green; font-size: 16px;">Login Success</div>';
} else {
  if (isset($_COOKIE["login_failure"])) {
      $login_message = '<div style=" color: red; font-size: 16px;">Login Failure</div>';
        setcookie("login_failure", '1', time() - 3600, '/', 'localhost'); }
        else {
        $login_message = '<div style="visibility: hidden; font-size: 16px;">Test</div>';
    }
  }


if (! empty($_POST["login"])) {
    $isAuthenticated = false;
    $username = $_POST["member_name"];
    $password = $_POST["member_password"];

    $user = $auth->getMemberByUsername($username);
    if (password_verify($password, $user[0]["member_password"])) {
        $isAuthenticated = true;
        $_SESSION["member_name"] = $username;
    }

    if ($isAuthenticated) {
        $_SESSION["member_id"] = $user[0]["member_id"];

        // Set Auth Cookies if 'Remember Me' checked
        if (! empty($_POST["remember"])) {
            setcookie("member_login", $username, $cookie_expiration_time, '/', 'localhost');

            $random_password = $util->getToken(16);
            setcookie("random_password", $random_password, $cookie_expiration_time, '/', 'localhost');

            $random_selector = $util->getToken(32);
            setcookie("random_selector", $random_selector, $cookie_expiration_time, '/', 'localhost');

            $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
            $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);

            $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);

            // mark existing token as expired
            $userToken = $auth->getTokenByUsername($username, 0);
            if (! empty($userToken[0]["id"])) {
                $auth->markAsExpired($userToken[0]["id"]);
            }
            // Insert new token
            $auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
        } else {
            $util->clearAuthCookie();

        }
        //$util->redirect("login_success.php");
    } else {
        $_SESSION["member_id"] = "";
          unset($_COOKIE['member_login']);
          session_destroy();
        $util->clearAuthCookie();
          setcookie("member_login", $username, time() - 3600, '/', 'localhost');
          setcookie("random_password", $username, time() - 3600, '/', 'localhost');
          setcookie("random_selector", $random_selector, time() - 3600, '/', 'localhost');
          setcookie("login_failure", '1', time() + 1, '/', 'localhost');
    }
    header("Refresh:0;");
}
?>

      <div id="login">
      <i style="font-size: 10em; padding: 15px 15px 0px 15px; color: #464d51;"class="material-icons">account_circle</i>
      <div id="login-panel">
      <p style="padding: 0px; margin-bottom: 10px;">Member Login</p>
      <div><?php if(isset($login_message)) { echo $login_message; } ?></div>
      <form action="" method="post">
        <input style="font-size: 16px" placeholder="Username" maxlength="40" type="text"  id="username" name="member_name" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"
        class="input-field"/> <br/>
        <input style="font-size: 16px" placeholder="Password" type="password" id="password" name="member_password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"
        class="input-field"/></br>
        <input id="login_button" type="submit" maxlength="50" name="login" value="login">

        <div id="remember_me_checkbox">
        <input type="checkbox" name="remember" id="remember"
        <?php if(isset($_COOKIE["member_login"])) { ?> checked
        <?php } ?> />

        <l for="rememberme">Remember Me</l>
        </div>
        <div id="forgot_password"><div><a><i>Forgot Password?</i></a></div></div>
      </form>
      </div>
      <div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

    <?php include_once "../core/header.php";?>                                                                                                                                        
