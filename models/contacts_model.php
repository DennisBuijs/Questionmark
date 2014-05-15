<?php

class Contacts_Model extends Model {

  public function __construct() {
    parent::__construct();
  }


  /**
   * Gets all the contacts
   * @return array contacts
   */
  public function get_all_contacts() {
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts");
  }


  /**
   * Gets contact by id
   * @param int $id Id of the contact to get
   * @return type
   */
  public function get_contact_by_id($id) {
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts WHERE id = :id", array(":id" => $id));
  }


  /**
   * Creates contact
   * @param array data of contact
   */
  public function create($data) {
    $this->db->insert("Contacts", $data);
  }


  /**
   * Edits contact
   * @param array $data data of contact
   * @param int $id Id of the contact to edit
   */
  public function edit($data, $id) {
    $this->db->update("Contacts", $data, "id = $id");
  }


  /**
   * Deletes contact
   * @param int $id of the contact
   */
  public function delete($id) {
    $this->db->delete("Contacts", "id = $id");
  }


}
