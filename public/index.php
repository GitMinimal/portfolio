<?php
$thisPage = "home";
if (!empty($_GET['p'])) {
  $thisPage = $_GET['p'];
}

?>
<?php include_once 'includes/header.php'; ?>
      <section class="parent">
        <?php include_once 'includes/nav.php';?>
        <section class="child">

        <?php

          if (!func::checkLoginState($dbh)) {
          }
          else {
            header("location:/pages/login.php");
          }

        ?>
        <?php
       //echo func::createString(32);

          $pages_dir = 'pages';

          if (!empty($_GET['p'])) {
            $pages = scandir($pages_dir, 0);
            unset($pages[0], $pages[1]);

            $p = $_GET['p'];

            if(in_array($p.'.inc.php', $pages)) {
              include($pages_dir.'/'.$p.'.inc.php');
            } else {
              echo 'Sorry, page not found!';
            }
          } else {
              include($pages_dir.'/home.inc.php');
            }
        ?>
      </section>
     </section>


<?php include_once 'includes/footer.php'; ?>
