<?php

class Enquete_Model extends Model {

  public function get_enquete_by_id($id) {
    return Enquete::get_enquete_by_id($id);
  }


  public function delete($id) {
    Enquete::delete($id);
  }


  public function edit() {


    // JSON word ingeladen vanuit frontend
    $json = file_get_contents("http://localhost:8888/Questionmark/public/js/edit.json");
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


  public function send() {
    print_r($_POST);
  }


}
