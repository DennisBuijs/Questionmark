<?php

/**
 * @todo set all properties!!
 */
class Enquete {

  public $id, $name, $introduction, $creation_date, $start_date, $end_date, $questions; // SESSIEONS G

  public function __construct($id) {
    $this->init($id);
  }


  static function make($name, $introduction, $start_date, $end_date, $user_id) {
    global $db;
    $data = array(
        "name" => $name,
        "introduction" => $introduction,
        "creation_date" => date("Y-m-d"),
        "start_date" => $start_date,
        "end_date" => $end_date,
        "Users_id" => $user_id
    );
    $db->insert('Enquetes', $data);
  }


  static function delete($id) {
    global $db;
    $db->delete("Enquetes", " id = $id");
  }


  static function edit($name, $introduction, $start_date, $end_date, $questions, $deleted_questions, $deleted_attributes, $enquete_id, $user_id) {

    global $db;

    $data = array(
        "name" => $name,
        "introduction" => $introduction,
        "start_date" => $start_date,
        "end_date" => $end_date,
        "Users_id" => $user_id
    );

    $db->update('Enquetes', $data, "id = $enquete_id");


    foreach ($questions as $question) {
      if (isset($question['id'])) {
        Question::edit($question, $deleted_attributes);
      }
      else {
        Question::make($question, $enquete_id);
      }
    }

    if (!empty($deleted_questions) && count($deleted_questions) > 0) {
      foreach ($deleted_questions as $deleted_question) {
        Question::delete($deleted_question);
      }
    }
  }


  private function init($id) {
    global $db;
    $this->id = $id;

    $sql = "SELECT Enquetes.*, Users.name AS username "
            . "FROM Enquetes "
            . "LEFT JOIN Users "
            . "ON Enquetes.Users_id = Users.id "
            . "WHERE Enquetes.id = :id";


    $data = $db->select($sql, array(":id" => $this->id));

    $this->name = $data[0]['name'];
    $this->introduction = $data[0]['introduction'];
    $this->creation_date = $data[0]['creation_date'];
    $this->start_date = $data[0]['start_date'];
    $this->end_date = $data[0]['end_date'];
    $this->creator = $data[0]['username'];
    $this->questions = Question::get_questions_by_enquete_id($id);
  }


  public static function get_all() {
    global $db;

    $sql = "SELECT id FROM Enquetes";
    $data = $db->select($sql);

    foreach ($data as $key => $value) {
      $enquetes[] = new self($value['id']);
    }

    if(isset($enquetes))
      return $enquetes; 
  }


  public static function get_enquete_by_id($id) {
    return new self($id);
  }


}
