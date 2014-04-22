<?php

class Controller {

  function __construct() {
    $this->view = new View();
    $this->view->seo = array('title' => 'Questionmark?');
  }


  public function load_model($name, $model_path) {

    $path = $model_path . $name . '_model.php';
    if (file_exists($path)) {
      require $path;
      $model_name = $name . '_Model';
      $this->model = new $model_name;
    }
  }


  public function logout() {
    Session::destroy();
    header("Location: " . URL . "/login");
    exit;
  }


}
