<?php

class Login_Model extends Model {

  public function get_seo() {
    return array('title' => 'Login Model');
  }


  public function run() {
    print_r($_POST);
  }


}
