<?php

class User_Controller extends Controller {

  public function __construct() {
    parent::__construct();
  }


  public function index() {

    $this->view->users = $this->model->get_all_users();

    $this->view->render('header');
    $this->view->render('user/index');
    $this->view->render('footer');
  }


  public function edit($id) {
    $this->view->user = $this->model->get_user_by_id($id)[0];

    $this->view->render('header');
    $this->view->render('user/edit');
    $this->view->render('footer');
  }


  public function save() {

    $data = array(
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => Hash::create($_POST['password'])
    );

    if ($_POST['type'] == 'create') {
      $this->model->create($data);
    }

    if ($_POST['type'] == 'edit') {

      if ($_POST['password'] == '') {
        unset($data['password']);
      }

      $this->model->edit($data, $_POST['id']);
    }

    header("Location: " . URL . "user");
  }


  public function delete($id) {
    $this->model->delete($id);
    header("Location: " . URL . "user");
  }


}
