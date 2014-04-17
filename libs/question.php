<?php

/**
 * @todo set all properties!!
 */
class Question {

  public $question, $type, $attributes;

  public function __construct($id) {
    $this->init($id);
  }


  private function init($id) {
    $this->id = $id;
    $this->question = $this->get_question();
    $this->attributes = $this->get_attributes();
    $this->type = $this->get_type();
    $this->order = $this->get_order();
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


  private function get_question() {
    global $db;
    $sql = "SELECT question FROM Questions where id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['question'];
  }


  private function get_type() {
    global $db;
    $sql = "SELECT Question_Types.type "
            . "FROM Question_Types, Questions "
            . "WHERE Questions.Question_Types_id = Question_Types.id "
            . "AND Questions.id = :id";

    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['type'];
  }


  private function get_attributes() {
    global $db;
    $sql = "SELECT attribute, Question_Attribute_Types_id "
            . "FROM Question_Attributes "
            . "WHERE `Questions_id` = :id";
    $data = $db->select($sql, array(":id" => $this->id));

    return $data;
  }


  private function get_order() {
    global $db;
    $sql = "SELECT `order` FROM Questions WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['order'];
  }


}
