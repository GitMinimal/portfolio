<?php
  if (! empty($_SESSION["member_id"])) {
    //header("location: /index.php");
    }
    else {
      header("location: ../pages/login.php?signin=error"); //error
    }
