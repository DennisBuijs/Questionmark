<?php

class Model {

  function __construct() {

    $config['database']['username'] = 'root';
    $config['database']['password'] = 'root';
    $config['database']['database'] = 'Questionmark';
    $config['database']['host'] = 'localhost';


    $this->db = new Database($config['database']);
  }
  
}
