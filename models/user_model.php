<?php

class User_Model extends Model {

  public function __construct() {
    parent::__construct();
  }


  public function get_all_users() {
    return $this->db->select("SELECT id, name, email, admin FROM Users");
  }


  public function get_user_by_id($id) {
    return $this->db->select("SELECT id, name, email FROM Users WHERE id = :id", array(":id" => $id));
  }


  public function create($data) {
    $this->db->insert("Users", $data);
  }


  public function edit($data, $id) {
    $this->db->update("Users", $data, "id = $id");
  }


  public function delete($id) {
    $this->db->delete("Users", "id = $id");
  }


}
