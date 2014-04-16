<?php

/**
 * @todo set all properties!!
 */
class Question {

  public function __construct($id) {
    $this->init($id);
  }


  private function init($id) {
    global $db;
    $sql = "SELECT * FROM Questions where id = :id";
    $data = $db->select($sql, array(":id" => $id));
    $this->id = $id;
    $this->question = $data[0]['question'];
    $this->types_id = $data[0]['Question_Types_id'];
    //$this->types_id = $data[0]['Question_Types_id'];
  }


  public static function get_questions_by_enquete_id($id) {
    global $db;

    $sql = "SELECT id FROM Questions WHERE Enquetes_id = :id";
    $data = $db->select($sql, array(":id" => $id));


    foreach ($data as $key => $value) {
      $questions[] = new self($value['id']);
    }
    return $questions;
  }


  public function get_question_by_id($id) {
    return new self($id);
  }


}
