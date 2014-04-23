<?php

/**
 * @todo set all properties!!
 */
class Question {

  public $question, $type, $attributes, $required, $order;

  public function __construct($id) {
    $this->init($id);
  }


  private function init($id) {
    $this->id = $id;
    $this->question = $this->get_question();
    $this->attributes = $this->get_attributes();
    $this->type = $this->get_type();
    $this->order = $this->get_order();
    $this->required = $this->get_required();
  }


  public static function edit($question) {
    global $db;

    $data = array(
        "question" => $question['question'],
        "order" => $question['order'],
        "required" => $question['required'],
        "Question_Types_id" => $db->select("SELECT id FROM Question_Types WHERE type = '{$question['type']}'")[0]['id'],
    );
    $db->update('Questions', $data);

    foreach ($question['attribute'] as $attr) {
      if (isset($question['attribute']['id'])) {
        self::update_attribute($question['attribute']);
      }
      else {
        self::make_attribute();
      }
    }
  }


  public static function make($question) {
    global $db;
  }


  public static function delete($id) {
    global $db;
    $db->delete("Questions", " id = $id");
  }


  private static function make_attribute() {
    global $db;
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
    $sql = "SELECT attr_types.attribute_type, question_attrs.attribute, question_attrs.id "
            . "FROM Question_Attribute_Types as attr_types "
            . "LEFT JOIN Question_Attributes as question_attrs "
            . "ON attr_types.id = question_attrs.Question_Attribute_types_id "
            . "WHERE question_attrs.Questions_id = :id";

    $data = $db->select($sql, array(":id" => $this->id));
    return $data;
  }


  private function get_order() {
    global $db;
    $sql = "SELECT `order` FROM Questions WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['order'];
  }

  private function get_required() {
    global $db;
    $sql = "SELECT `required` FROM Questions WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['required'];
  }
  

}
