<?php

class User_Model extends Model {

  public function __construct() {
    parent::__construct();
  }


  /**
   * Gets all users
   * @return array Users
   */
  public function get_all_users() {
    return $this->db->select("SELECT id, name, email, admin FROM Users");
  }


  /**
   * Gets user by user id
   * @param int $id Id of the user
   * @return array User
   */
  public function get_user_by_id($id) {
    return $this->db->select("SELECT id, name, email FROM Users WHERE id = :id", array(":id" => $id));
  }


  /**
   * Creates user
   * @param array $data
   */
  public function create($data) {
    $this->db->insert("Users", $data);
  }


  /**
   * Edits user
   * @param array $data User
   * @param int $id
   */
  public function edit($data, $id) {
    $this->db->update("Users", $data, "id = $id");
  }


  /**
   * Deletes user by id
   * @param int $id Id of user
   */
  public function delete($id) {
    $this->db->delete("Users", "id = $id");
  }


  /**
   * Generates a random password
   * @param int $password_length Length of the password
   * @return string random password
   */
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


  /**
   * Mails the user his password
   * @param string $mailadres
   * @param string $name
   * @param string $password
   */
  public function mail($mailaddress, $name, $password) {
    $mail = file_get_contents("mails/user.html");
    $mail = str_replace('$name', $name, $mail);
    $mail = str_replace('$password', $name, $password);

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Bio Beaker - QuestionMark <no-reply@biobeaker.com>' . "\r\n";
    mail($mailaddress, 'Account gegevens - Questionmark?', $mail, $headers);
  }


}
