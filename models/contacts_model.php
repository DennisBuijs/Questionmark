<?php

class Contacts_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  
  public function get_all_contacts() {
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts");
  }


  public function get_contact_by_id($id) {
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts WHERE id = :id", array(":id" => $id));
  }

  public function create($data) {
    $this->db->insert("Contacts", $data);
  }


  public function edit($data, $id) {
    $this->db->update("Contacts", $data, "id = $id");
  }


  public function delete($id) {
    $this->db->delete("Contacts", "id = $id");
  }


}
