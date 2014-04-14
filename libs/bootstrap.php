<?php

class Bootstrap {

  private $_URL;
  private $_controller;
  private $_model_path = "models/";
  private $_controller_path = "controllers/";
  private $_error_file = "error_controller.php";
  private $_default_file = "index_controller.php";
  private $_input;

  public function init() {
    // Sets the private $_URL
    $this->_get_URL();

    // Load the default controller if $_URL is not set
    if (empty($this->_URL[0])) {
      $this->_load_default_controller();
      return false;
    }

    $this->_load_existing_controller();
    $this->_call_controller_method();
  }


  public function set_model_path($path) {
    $this->_model_path = trim($path, "/") . "/";
  }


  public function set_controller_path($path) {
    $this->_controller_path = trim($path, "/") . "/";
  }


  public function set_error_file($path) {
    $this->_error_file = trim($path, "/");
  }


  public function set_default_file($path) {
    $this->_default_file = trim($path, "/");
  }


  private function _get_URL() {
    $this->_input = Input::create_from_globals();
    if ($this->_input->get("url"))
      $url = $this->_input->get("url");
    else
      $url = null;
    $url = rtrim($url);
    $this->_URL = explode("/", $url);
  }


  private function _load_default_controller() {
    require $this->_controller_path . $this->_default_file;
    $this->_controller = new Index_Controller();
    $this->_controller->load_model("index", $this->_model_path);
    $this->_controller->index();
  }


  private function _load_existing_controller() {
    $file = $this->_controller_path . $this->_URL[0] . "_controller.php";

    if (file_exists($file)) {
      require_once $file;

      $class = $this->_URL[0] . "_Controller";
      $this->_controller = new $class;
      $this->_controller->load_model($this->_URL[0], $this->_model_path);
    }
    else {
      $this->_error();
      return false;
    }
  }


  private function _call_controller_method() {

    $length = count($this->_URL);
    if ($length > 1) {
      if (!method_exists($this->_controller, $this->_URL[1])) {
        $this->_error();
      }
    }
    switch ($length) {
      case 5:
        $this->_controller->{$this->_URL[1]}($this->_URL[2], $this->_URL[3], $this->_URL[4]);
        break;
      case 4:
        $this->_controller->{$this->_URL[1]}($this->_URL[2], $this->_URL[3]);
        break;
      case 3:
        $this->_controller->{$this->_URL[1]}($this->_URL[2]);
        break;
      case 2:
        $this->_controller->{$this->_URL[1]}();
        break;
      default:
        $this->_controller->index();
        break;
    }
  }


  private function _error() {
    require_once $this->_controller_path . "/" . $this->_error_file;
    $this->_controller = new Error_Controller();
    $this->_controller->index();
    exit;
  }


}
