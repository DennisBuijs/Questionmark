<?php

class Enquete_Controller extends Controller {

  function __construct() {
    parent::__construct();
    Auth::handle_login();
  }


  public function index($id) {

    $this->view->seo = $this->model->get_seo();
    $this->view->enquete = $this->model->get_enquete_by_id($id);

    $this->view->render('header');
    $this->view->render('enquete/index');
    $this->view->render('footer');
  }

  public function edit($id) {

    $this->view->seo = $this->model->get_seo();
    $this->view->enquete = $this->model->get_enquete_by_id($id);

    $this->view->render('header');
    $this->view->render('enquete/edit');
    $this->view->render('footer');

  }


}
