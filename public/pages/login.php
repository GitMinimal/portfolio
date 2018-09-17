<?php include_once("../includes/header.php")?>
<?php include_once("../../auth/functions.php")?>



<section class="parent">
  <section class="child">
<?php

  if(isset($_SESSION['username'])) {
      redirect();
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
            header("location: /index.php");
            func::createString(32);
          }
        }
      }

      loginErrorCheck();
    ?>
</section>
</section>

<?php include_once("../includes/footer.php"); ?>
