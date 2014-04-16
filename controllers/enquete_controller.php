<?php

class Enquete_Controller extends Controller {

  function __construct() {
    parent::__construct();
    Auth::handle_login();
  }


  public function index() {

    $this->view->seo = $this->model->get_seo();

    $this->view->render('header');
    $this->view->render('enquete/index');
    $this->view->render('footer');
  }

  public function edit() {

    $this->view->render('header');
    $this->view->render('enquete/edit');
    $this->view->render('footer');

  }


}
