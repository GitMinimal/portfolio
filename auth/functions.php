<?php

  class func {

    public static function checkLoginState($dbh) {

      if(!isset($_SESSION)) {
        ini_set();
        session_start();

      }


      if (isset($_COOKIE['userid']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])) {

        $query = "SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token AND session_serial = :serial;";

        $user_id = $_COOKIE['userid'];
        $token = $_COOKIE['token'];
        $serial = $_COOKIE['serial'];

        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':userid' => $user_id,
                             ':token' => $token,
                             ':serial' => $serial));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['session_userid'] > 0) {

          if ($row['session_userid'] == $_COOKIE['userid'] && $row['session_token'] == $_COOKIE['token'] && $row['sessions_serial'] == $_COOKIE['serial']) {

            if ($row['session_userid'] == $_SESSION['userid'] && $row['session_token'] == $_SESSION['token'] && $row['sessions_serial'] == $_SESSION['serial']){
              return true;
            }
            else {
              createSession($_COOKIE['username'], $_COOKIE['token'], $_COOKIE['serial']);
              return true;
            }
          }
        }
      }
    }

    public static function createRecord($dbh, $user_id, $user_username) {

      $query = "INSERT INTO sessions (session_userid, session_token, session_serial) VALUES (:user_id, :token, :serial);";

      $dbh->prepare("DELETE FROM sessions WHERE session_userid = :session_userid;")->execute(array(':session_userid' => $user_id));

        $token = func::createString(34);
        $serial = func::createString(34);

        func::createCookie($user_username, $user_id, $token, $serial);
        func::createSession($user_username, $user_id, $token, $serial);

        $stmt = $dbh->prepare($query);
        $stmt->execute(array('userid' => $user_id,
                             ':token' => $token,
                             ':serial' => $serial));
    }

    public static function createCookie($user_username, $user_id, $token, $serial) {

      if(isset($_POST['remember'])) {
        setCookie('userid', $user_id, time() + (86400) * 30, "/");
        setCookie('username', $user_username, time() + (86400) * 30, "/");
        setCookie('token', $token, time() + (86400) * 30, "/");
        setCookie('serial', $serial, time() + (86400) * 30, "/");
        setCookie('remember', 'Remember Me', time() + (86400) * 30, "/");
      } else {
        setCookie('userid', $user_id, time() -1, "/");
        setCookie('username', $user_username, time() -1, "/");
        setCookie('token', $token, time() -1, "/");
        setCookie('serial', $serial, time() -1, "/");
      }
    }

    public static function deleteCookie() {

      setCookie('userid', $user_id, time() -1, "/");
      setCookie('username', $user_username, time() -1, "/");
      setCookie('token', $token, time() -1, "/");
      setCookie('serial', $serial, time() -1, "/");
      session_destroy();

    }

    public static function createSession($user_username, $user_id, $token, $serial) {

      if (!isset($_SESSION)) {
          ini_set();
          session_start();
      }

      $_SESSION['userid'] = $user_id;
      $_SESSION['token'] = $token;
      $_SESSION['serial'] = $serial;
      $_SESSION['username'] = $user_username;

    }

    public static function createString($len) {

      $string = "1ZHESkJNZUEYjH9755M69xx5vYpKpks08TBYgRWzHO632vE8gx6PE51vUy8yA";
      $s = "";
      $r_new = "";
      $r_old = "";

      for ($i = 1; $i < $len; $i++) {
        while ($r_old == $r_new) {
          $r_new = rand(0, 60);
        }

        $r_old = $r_new;
        $s = $s.$string[$r_new];
      }
      return $s;
    }

  }

  function redirect() {
    header('location: http://www.localhost/index.php');
  }
























 ?>
