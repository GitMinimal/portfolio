<?php

    // These variables define the connection information for your MySQL database
    //$username = "sec_user";
    //$password = "TQfnuRZ15EHl3g4N";
    //$server = "localhost";
    //$database = "login_sys";

    ini_set('display_error', 1);
    ini_set('display_error', 1);
    error_reporting(E_ALL);

    $dbh = new PDO('mysql:host=localhost;dbname=secure_login', 'root', '');

    $stmt = $dbh->prepare("SELECT * FROM users;");
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
      //echo $row['user_username'];
    }

?>
