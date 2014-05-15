<?php

class Model {

  /**
   * Makes a Database object
   */
  function __construct() {

    $config['database']['username'] = 'root';
    $config['database']['password'] = 'root';
    $config['database']['database'] = 'Questionmark';
    $config['database']['host'] = 'localhost';

    $this->db = new Database($config['database']);
  }


}
