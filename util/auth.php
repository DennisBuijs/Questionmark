<?php

class Auth {

  public static function handle_login($check_if_admin = false) {
    @session_start();
    if (!isset($_SESSION['logged_in'])) {
      session_destroy();
      header("Location: login");
      exit;
    }

    if ($check_if_admin) {
      if ($_SESSION['user_type'] != 'admin') {
        session_destroy();
        header("Location: login");
        exit;
      }
    }
  }

}
