<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/portfolio/auth/authCookieSessionValidate.php';

if(!$isLoggedIn) {
    header("Location: ../index.php");
}
?>
<style>
.member-dashboard {
    padding: 40px;
    background: #D2EDD5;
    color: #555;
    border-radius: 4px;
    display: inline-block;
}

.member-dashboard a {
    color: #09F;
    text-decoration: none;
}
</style>
<div class="member-dashboard">
    You have Successfully logged in!. <a href="/pages/logout.php">Logout</a>
</div>
