<?php
include_once '../core/header.php';
require_once $_SERVER['DOCUMENT_ROOT']."/portfolio/auth/Auth.php";
require_once $_SERVER['DOCUMENT_ROOT']."/portfolio/auth/Util.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();

require_once $_SERVER['DOCUMENT_ROOT'].'/portfolio/auth/authCookieSessionValidate.php';

if ($isLoggedIn) {
    $util->redirect("login_success.php");
}

if (! empty($_POST["login"])) {
    $isAuthenticated = false;

    $username = $_POST["member_name"];
    $password = $_POST["member_password"];

    $user = $auth->getMemberByUsername($username);
    if (password_verify($password, $user[0]["member_password"])) {
        $isAuthenticated = true;
    }

    if ($isAuthenticated) {
        $_SESSION["member_id"] = $user[0]["member_id"];
        setcookie("member_login", $username, time() + 60 * 60, '/');

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
        $util->redirect("login_success.php");
    } else {
        $message = "Invalid Login";
    }
}
?>

      <div id="login">
      <i style="font-size: 10em; padding: 15px 15px 0px 15px; color: #464d51;"class="material-icons">account_circle</i>
      <div id="login-panel">
      <p style="padding: 0px; margin: 0px;">Member Login</p>

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
