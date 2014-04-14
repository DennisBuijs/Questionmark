<?php

class DEBUG {

  /**
   * Print out array with pre tags
   * @param array $array Data to print out.
   */
  public static function print_var($array, $bDie = false) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    if ($bDie)
      die();
  }

}