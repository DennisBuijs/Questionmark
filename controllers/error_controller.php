<?php


class Error_Controller extends Controller {
  
  public function __construct() {
    parent::__construct();
  }
  
  public function index() {
    
    $this->view->seo['title'] = "404 | Questionmark?";

    $this->view->render('header');
    $this->view->render('error/index');
    $this->view->render('footer');
  }
  
  
}