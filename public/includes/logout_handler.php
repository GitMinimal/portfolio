<?php
session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_unset();
session_destroy();
     header('Location: index.php?p=logout');

     require $_SERVER['DOCUMENT_ROOT']."/portfolio/auth/Util.php";
     $util = new Util();

     $_SESSION["member_id"] = "";
      session_unset();
      session_destroy();

     $util->clearAuthCookie();

     header("Location: ./");
?>





<section class="logout"></section>
