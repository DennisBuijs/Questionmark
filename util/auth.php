<?php

class Auth {

  public static function handle_login() {
    @session_start();
    if (!isset($_SESSION['logged_on'])) {
      session_destroy();
      header("Location: " . URL . "login");
      exit;
    }
  }


}
