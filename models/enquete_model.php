<?php

class Enquete_Model extends Model {

  /**
   * Gets enquete to by id
   * @param int $id The id of the enqeute
   * @return object Enquete object
   */
  public function get_enquete_by_id($id) {
    return Enquete::get_enquete_by_id($id);
  }


  /**
   * Deletes enquete
   * @param int $id The id of the enqeute
   */
  public function delete($id) {
    Enquete::delete($id);
  }


  /**
   * Makes enquete
   */
  public function make() {
    Enquete::make("Naamloze Enquete", '', '', '', Session::get('user_id'));
  }


  /**
   * edits enqeute
   */
  public function edit() {
    $json = $_POST['json'];
    $enquete = json_decode($json, true);

    $name = $enquete['name'];
    $introduction = $enquete['introduction'];
    $start_date = $enquete['start_date'];
    $end_date = $enquete['end_date'];
    $questions = $enquete['questions'];
    $deleted_questions = $enquete['deleted_question'];
    $deleted_attributes = $enquete['deleted_attributes'];
    $enquete_id = $enquete['id'];
    $user_id = $_SESSION['user_id'];

    Enquete::edit($name, $introduction, $start_date, $end_date, $questions, $deleted_questions, $deleted_attributes, $enquete_id, $user_id);
  }


  /**
   * sends enquete to contacts
   */
  public function send() {

    $message = $_POST['message'];
    foreach ($_POST['contacts'] as $contact_id) {

      $message_temp = $message;
      $data = $this->get_contact_by_id($contact_id);

      $first_name = $data["first_name"];
      $last_name = $data['last_name'];
      $email = $data['email'];
      $id = $data['id'];

      $message_temp = str_replace("{{first_name}}", $first_name, $message_temp);
      $message_temp = str_replace("{{last_name}}", $last_name, $message_temp);
      $message_temp = str_replace("{{email}}", $email, $message_temp);
      $message_temp = str_replace("{{id}}", $last_name, $message_temp);

      mail($email, "Eqnuete", $message_temp);
    }

    header("Location: " . URL);
  }


  public function save() {

    $message = "Hallo, \r\n"
            . "\r\n"
            . "De enquete '{$_POST['enquete_name']}' ingevuld. Hieronder de resultaten \r\n \r\n \r\n";

    foreach ($_POST['questions'] as $question) {
      $message .= $question['question'] . " \r\n";

      if (isset($question['answer']) && is_array($question['answer']) && count($question['answer']) > 0) {
        foreach ($question['answer'] as $answer) {
          $message .= $answer . " \r\n";
        }
        $message .= "\r\n \r\n";
      }
      else {
        if (isset($question['answer']))
          $message .= $question['answer'] . " \r\n \r\n \r\n";
      }
    }

    $message .= "Met vriendelijke groet, \r\n \r\n";
    $message .= "Team Dennis";

    // mail("admin@gmail.com", "Er is een enquete ingevuld", $message);
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
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts WHERE id = :id", array(":id" => $id))[0];
  }


}
