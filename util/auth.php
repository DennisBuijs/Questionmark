<?php

class Auth {
  /**
   * If user is logged on, he wil get acces to the webapplication.
   */
  public static function handle_login() {
    @session_start();
    if (!isset($_SESSION['logged_on'])) {
      session_destroy();
      header("Location: " . URL . "login");
      exit;
    }
  }


}
