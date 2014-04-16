<?php

class Login_Model extends Model {

  public function get_seo() {
    return array('title' => 'Questionmark?');
  }

  /**
   * Run
   * Data moet nog worden gevalideerd
   */
  public function run() {

    $data = array(":name" => $_POST["login_username"], ":password" => Hash::create($_POST["login_password"]));
    $user = $this->db->select("SELECT id FROM Users WHERE name = :name AND password = :password", $data);

    if (count($user) > 0) {
      Session::init();
      Session::set('logged_on', true);
      Session::set('user_id', $user[0]['id']);
      header("Location: " . URL . "index");
    }
    else {
      header("Location: " . URL . "login");
    }
  }


}
