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


  public function generate_password($password_length = 25) {

    for ($counter = 0; $counter < $password_length; $counter++) {

      $case = rand(0, 1);

      if ($case == 0)
        $number = rand(65, 90);
      else
        $number = rand(97, 122);

      $char[$counter] = chr($number);
    }
    $password = implode($char);

    return $password;
  }


  public function mail($mailadres, $name, $password) {
    $mail = "Beste $name, \r\n"
            . "\r\n"
            . "Er is voor u een account aangemaakt. Hieronder staan de gegevens."
            . "Naam: $name \r\n"
            . "Wachtwoord: $password \r\n"
            . "\r\n"
            . "Met vriendelijke groet, \r\n"
            . "\r\n"
            . "Team Dennis";

    mail($mailadres, 'Account gegevens - Questionmark?', $mail);
  }


}
