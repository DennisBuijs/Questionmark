<?php

class Enquete_Controller extends Controller {

  function __construct() {
    parent::__construct();
    Auth::handle_login();
  }


  public function index($id) {

    $this->view->enquete = $this->model->get_enquete_by_id($id);

    $this->view->render('header');
    $this->view->render('enquete/index');
    $this->view->render('footer');
  }


  public function edit($id) {

    $this->view->enquete = $this->model->get_enquete_by_id($id);

    $this->view->render('header');
    $this->view->render('enquete/edit');
    $this->view->render('footer');
  }


  public function delete($id) {
    $this->model->delete($id);
    header('Location: ' . URL);
  }


  public function send($id) {

    $this->view->form_id = $id;
    $this->view->contacts = $this->model->get_all_contacts();

    $this->view->render('header');
    $this->view->render('enquete/send');
    $this->view->render('footer');
  }


  public function run() {
    switch ($_POST['type']) {
      case 'send' :
        $this->model->send();
        header("Location: " . URL );
        break;
      case 'edit' :
        $this->model->edit();
        break;
      case 'vulin'/* MOET NOG GOEIE NAAM BEDENKEN */ :
        break;
      default :
        break;
    }
  }


}
