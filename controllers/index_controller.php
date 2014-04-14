<?php

class Index_Controller extends Controller {

  function __construct() {
    parent::__construct();
  }


  public function index() {

    $this->view->seo = $this->model->get_seo();
    $this->view->enquetes = $this->model->get_all_enquetes();

    $this->view->render('header');
    $this->view->render('index/index');
    $this->view->render('footer');
  }
  

}