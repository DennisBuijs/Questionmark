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


  /**
   * Sets the path to the model folder
   * @param string $path Name of the model folder
   */
  public function set_model_path($path) {
    $this->_model_path = trim($path, "/") . "/";
  }

  /**
   * Sets the path to the controller folder
   * @param string $path Name of the controller folder
   */
  public function set_controller_path($path) {
    $this->_controller_path = trim($path, "/") . "/";
  }

  /**
   * Sets the path to the error controller
   * @param string $path path to the error controller
   */
  public function set_error_file($path) {
    $this->_error_file = trim($path, "/");
  }

  /**
   * Sets the path to the default controller
   * @param string $path Path to the default controller
   */
  public function set_default_file($path) {
    $this->_default_file = trim($path, "/");
  }

  /**
   * Gets URL from $_GET parameters
   */
  private function _get_URL() {
    $this->_input = Input::create_from_globals();
    if ($this->_input->get("url"))
      $url = $this->_input->get("url");
    else
      $url = null;
    $url = rtrim($url);
    $this->_URL = explode("/", $url);
  }


  /**
   * Loads the default controller
   */
  private function _load_default_controller() {
    require $this->_controller_path . $this->_default_file;
    $this->_controller = new Index_Controller();
    $this->_controller->load_model("index", $this->_model_path);
    $this->_controller->index();
  }

  /**
   * Loads existing controller   
   * @return boolean When it can not include the controller file, it return false
   */
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

  
  /**
   * Calls the method en passes arguments from $_GET Parameters 
   */
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

  /**
   * Loads Errorpage
   */
  private function _error() {
    require_once $this->_controller_path . "/" . $this->_error_file;
    $this->_controller = new Error_Controller();
    $this->_controller->index();
    exit;
  }


}
