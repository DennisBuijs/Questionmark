<?php

class Login_Controller extends Controller {

  function __construct() {
    parent::__construct();

    if (Session::get("logged_in")) {
      header("Location: " . URL . "index");
    }
  }


  public function index() {

    $this->view->render('header');
    $this->view->render('login/index');
    $this->view->render('footer');
  }


  public function run() {
    $this->model->run();
  }


  public function error() {
    $this->view->error = true;
  }


}
