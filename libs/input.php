<?php

class Input {

  protected $inputs = ['get' => [], 'post' => []];

  /**
   * Creates object from $_POST en $_GET
   * @return \static
   */
  public static function create_from_globals() {
    return new static(['get' => $_GET, 'post' => $_POST]);
  }


  public function __construct($inputs = []) {
    $this->replace($inputs);
  }


  /**
   * Replaces values
   * @param array $inputs
   */
  public function replace($inputs = []) {
    foreach ($this->inputs as $key => $input) {
      if (isset($inputs[$key])) {
        $this->inputs[$key] = $inputs[$key];
      }
    }
  }


  /**
   * Get
   * @param string $key
   * @return string Value
   */
  public function get($key) {
    return $this->fetch('get', $key);
  }


  /**
   * post
   * @param string $key
   * @return type value
   */
  public function post($key) {
    return $this->fetch('get', $key);
  }


  /**
   * Fetch
   * @param string $input
   * @param string $key
   * @return string
   */
  protected function fetch($input, $key) {
    if (isset($this->inputs[$input][$key]))
      return $this->inputs[$input][$key];
  }


}
