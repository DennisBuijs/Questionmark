<?php

class Model {

  /**
   * Makes a Database object
   */
  function __construct() {
    global $config;
    $this->db = new Database($config['database']);
  }


}
