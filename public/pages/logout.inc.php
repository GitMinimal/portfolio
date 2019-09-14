<?php
$thisPage="logout";
     require $_SERVER['DOCUMENT_ROOT']."/portfolio/auth/Util.php";
     $util = new Util();

     $_SESSION["member_id"] = "";
     unset($_COOKIE['member_login']);
     session_destroy();

     $util->clearAuthCookie();
     setcookie("member_login", $username, time() - 3600, '/', 'localhost');
     setcookie("random_password", $random_password, time() - 3600, '/', 'localhost');
     setcookie("random_selector", $random_selector, time() - 3600, '/', 'localhost');


     header("Refresh:0; url=index.php");
     $message = "Invalid Login";
?>





<section class="logout"></section>
