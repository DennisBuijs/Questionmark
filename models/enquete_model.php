<?php

class Enquete_Model extends Model {

  public function get_enquete_by_id($id) {
    return Enquete::get_enquete_by_id($id);
  }


  public function delete($id) {
    Enquete::delete($id);
  }

  
  public function make(){
    Enquete::make("Naamloze Enquete", '', '', '', Session::get('user_id'));
  }

  public function edit() {


    $json = $_POST['json'];
    $enquete = json_decode($json, true);

    $name = $enquete['name'];
    $introduction = $enquete['introduction'];
    $start_date = "2014-04-15" /* $enquete['start_date'] */;
    $end_date = "2014-04-15" /* $enquete['end_date'] */;
    $questions = $enquete['questions'];
    $deleted_questions = $enquete['deleted_question'];
    $deleted_attributes = $enquete['deleted_attributes'];
    $enquete_id = $enquete['id'];
    $user_id = $_SESSION['user_id'];

    Enquete::edit($name, $introduction, $start_date, $end_date, $questions, $deleted_questions, $deleted_attributes, $enquete_id, $user_id);
  }


  public function get_all_contacts() {
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts");
  }


  public function get_contact_by_id($id) {
    return $this->db->select("SELECT id, first_name, last_name, email FROM Contacts WHERE id = :id", array(":id" => $id))[0];
  }


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

      // mail();
    }

     header("Location: " . URL);
  }


}
