<?php

class Session {

  /**
   * Init sessions
   */
  public static function init() {
    return @session_start();
  }


  /**
   * Destroy session
   */
  public static function destroy() {
    return session_destroy();
  }


  /**
   * Set session
   * @param string $key
   * @param string $value
   */
  public static function set($key, $value) {
    $_SESSION[$key] = $value;
  }


  /**
   * Get session
   * @param string $key
   * @return mixed value 
   */
  public static function get($key) {
    if (isset($_SESSION[$key]))
      return $_SESSION[$key];
  }


}
