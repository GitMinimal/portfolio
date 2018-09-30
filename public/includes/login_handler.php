<?php ob_start(); ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/portfolio/auth/functions.php'; include_once $_SERVER['DOCUMENT_ROOT'] . '/portfolio/auth/config.php'; ?>

<?php
session_start();

if (!func::checkLoginState($dbh)) {

  if (isset($_POST['username']) && isset($_POST['password'])) {

    $query = "SELECT * FROM users WHERE (user_username = :username OR user_email = :username) AND user_password = :password";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':username' => $username, ':password' => $password));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['user_id'] > 0) {
      func::createRecord($dbh, $row['user_id'], $row['user_username']);
      header("location: /index.php");
      func::createString(32);
    }
    else {
      header("location: ../pages/login.php?signin=error"); //error
    }
  }
}
