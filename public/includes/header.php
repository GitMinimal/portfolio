<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/portfolio/auth/functions.php'; include_once $_SERVER['DOCUMENT_ROOT'] . '/portfolio/auth/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="/portfolio/public/css/style.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">


      <title>Portfolio</title>
  </head>
  <body>

    <header>
      <div id="nav-open">
   <div class="nav-open-container">
     <div class="nav-open-logo-container">
       <div class="header-logo">
         <img src="/portfolio/public/assets/logo.svg"></img>
       </div>
    </div>
      <div class="nav-close-button-wrapper">
        <i class="nav-close-button material-icons">close</i>
      </div>
   </div>
   <div class="nav-body">
     <ul class="nav-links">
       <ul>
         <a href="/index.php"><li style="padding-left: 40px;">Home</li></a>
         <a href="index.php?p=about"><li style="padding-left: 40px;">About Me</li></a>
         <a href="index.php?p=portfolio"><li style="padding-left: 40px;">Portfolio</li></a>
       </ul>

       <ul>
         <a href="https://www.behance.net/InfinityArts" target="_blank"><li style="padding-left: 40px;">Graphical Designs<i class="material-icons open-header-icons">open_in_new</i></li></a>
         <a href="https://www.youtube.com/InfinityArts" target="_blank"><li style="padding-left: 40px;">Youtube<i class="material-icons open-header-icons">open_in_new</i></li></a>
         <a href="https://www.linkedin.com/in/bretpeavy/" target="_blank"><li style="padding-left: 40px;">Linkedin<i class="material-icons open-header-icons">open_in_new</i></li></a>
         <a href="https://github.com/GitMinimal/" target="_blank"><li style="padding-left: 40px;">Github<i class="material-icons open-header-icons">open_in_new</i></li></a>
       </ul>
       <ul>
         <a href="index.php?p=contact"><li style="padding-left: 40px;">Contact<i class="material-icons open-header-icons">mail_outline</i></li></a>
         <a href="index.php?p=support"><li style="padding-left: 40px;">Support<i class="material-icons open-header-icons">help</i></li></a>
       </ul>
     </ul>
     <div class="nav-slider"
        <?php
        if ($thisPage=="home") {
        echo 'style="top: 60px"';
      } else if ($thisPage=="about") {
        echo 'style="top: 110px"';
      } else if ($thisPage=="contact") {
        echo 'style="top: 406px"';
      }


      ?>

      ></div>
   </div>
 </div>
 <div class="logout-background">
     <div class="logout_timer_page">
       <div id="logout_timer_container">
         <l>Are you sure you want to logout?</l>
         <l id="timer">5</l>
         <a href="javascript:history.go(0)">Cancel</a>
       </div>
     </div>
   </div>




  <div class="shadow">
  </div>

      <div class="nav-bar-container">
        <div id="nav-bar-left">
          <div class="header-button-container">
       <div class="header-button">
        <i class="material-icons">code</i>
       </div>
       <p>Menu</p>
     </div>
          <img src="/portfolio/public/assets/logo.svg"></img>
        </div>
        <div id="nav-bar-center">
        </div>
        <div id="nav-bar-right">
          <a href="#" style ="color: #059dfa !important;">
          <?php

          if(!isset($_SESSION)){

            session_start();

            if(!empty($_SESSION['username'])) {
                echo '<l style="color: #464d51">Welcome, </l>'. '<l id="header-username">' .ucfirst($_SESSION['username']) . '!</l>';
                echo '<a id="logout" href="/includes/logout.php"><i class="material-icons">power_settings_new</i></a>';
              } else {
                echo '<a href="/pages/login.php">Login</a><p>|</p><a href="/pages/register.php">Register</a>';
              }
            }

            ?>
          </a>
        </div>
      </div>
    </header>
