<?php
//Sets page to home
$thisPage = "home";
if (!empty($_GET['p'])) {
  $thisPage = $_GET['p'];
}

?>
<?php include_once 'core/header.php'; ?>
      <section class="parent">
        <?php include_once 'core/nav.php';?>
        <section class="child">
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


<?php include_once 'core/footer.php'; ?>
