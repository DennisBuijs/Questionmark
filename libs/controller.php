<?php

class Controller {

  /**
   * Initializes Controller
   */
  function __construct() {
    $this->view = new View();
    $this->view->seo = array('title' => 'Questionmark?');
  }

  /**
   * Loads and sets the model
   * @param string $name The name of the model
   * @param string $model_path The path to the model
   */
  public function load_model($name, $model_path) {

    $path = $model_path . $name . '_model.php';
    if (file_exists($path)) {
      require $path;
      $model_name = $name . '_Model';
      $this->model = new $model_name;
    }
  }

  /**
   * User logout
   */
  public function logout() {
    Session::destroy();
    header("Location: " . URL . "/login");
    exit;
  }


}
