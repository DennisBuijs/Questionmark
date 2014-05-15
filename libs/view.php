<?php

class View {

  function __construct() {
    
  }


  /**
   * Render
   * @param string $name name of the folder en file
   */
  public function render($name) {
    require 'views/' . $name . '.php';
  }


}
