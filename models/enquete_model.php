<?php

class Enquete_Model extends Model {

  /**
   * Gets enquete to by id
   * @param int $id The id of the enquete
   * @return object Enquete object
   */
  public function get_enquete_by_id($id) {
    return Enquete::get_enquete_by_id($id);
  }


  /**
   * Deletes enquete
   * @param int $id The id of the enquete
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
   * edits enquete
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

      $data = $this->get_contact_by_id($contact_id);

      $first_name = $data["first_name"];
      $last_name = $data['last_name'];
      $email = $data['email'];
      $id = $data['id'];
      
      $message = str_replace("{{first_name}}", $first_name, $message);
      $message = str_replace("{{last_name}}", $last_name, $message);
      $message = str_replace("{{email}}", $email, $message);
      $message = str_replace("{{id}}", $last_name, $message);
      $message = str_replace("\r\n", "<br />", $message);     
      
      $message = "<div style=\"font-family:'helvetica neue', helvetica, arial, sans-serif; font-weight: 300; font-size: 16px;\">" . $message . "<br /><img src=\"http://www.biobeaker.nl/questionmark/public/images/logo.png\" alt=\"Logo van Bio Beaker\"/> </div>";
      
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Bio Beaker - QuestionMark <no-reply@biobeaker.com>' . "\r\n";
      
      mail($email, "Equete uitnodiging Bio Beaker", $message, $headers);
    }

    header("Location: " . URL);
  }


  public function save() {

    $message = "Hallo, \r\n"
            . "\r\n"
            . "De enquete '{$_POST['enquete_name']}' ingevuld. Hieronder de resultaten \r\n \r\n \r\n";

    if (isset($_POST['questions']) && count($_POST['questions']) > 0) {
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
    }

    $message .= "Met vriendelijke groet, \r\n \r\n";
    $message .= "Team Dennis";

    $data = $this->db->select("SELECT email FROM Users WHERE admin = 1");
    $emailaddress = $data[0]['email'];

    mail($emailaddress, "Er is een enquete ingevuld", $message);

    $data = 
   $insert = $this->db->insert("Answers", $data);

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


  public function get_results($id) {
    
    return $this->db->select("SELECT * FROM Answers WHERE");
    
  }


}
