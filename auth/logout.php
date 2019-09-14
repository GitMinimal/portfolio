<?php
session_start();

require "Util.php";
$util = new Util();

//Clear Session
$_SESSION["member_id"] = "", time() - 3600);
setcookie("member_login", "", time() - 3600, "/");
session_destroy();

// clear cookies
$util->clearAuthCookie();

header("Location: ./");
?>
