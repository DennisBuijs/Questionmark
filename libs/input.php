<?php

class Input {

  protected $inputs = ['get' => [], 'post' => []];

  public static function create_from_globals() {
    return new static(['get' => $_GET, 'post' => $_POST]);
  }


  public function __construct($inputs = []) {
    $this->replace($inputs);
  }


  public function replace($inputs = []) {
    foreach ($this->inputs as $key => $input) {
      if (isset($inputs[$key])) {
        $this->inputs[$key] = $inputs[$key];
      }
    }
  }


  public function get($key) {
    return $this->fetch('get', $key);
  }


  public function post($key) {
    return $this->fetch('get', $key);
  }


  protected function fetch($input, $key) {
    if (isset($this->inputs[$input][$key])) {
      return $this->inputs[$input][$key];
    }
  }


}
