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


  public static function edit($question, $deleted_attributes) {
    global $db;

    $data = array(
        "question" => $question['question'],
        "order" => $question['order'],
        "required" => $question['required'],
        "Question_Types_id" => $db->select("SELECT id FROM Question_Types WHERE type = '{$question['type']}'")[0]['id'],
    );

    $db->update('Questions', $data, "id = {$question['id']}");

    foreach ($question['attributes'] as $attr) {
      if (isset($attr['id'])) {
        self::edit_attribute($attr, $question['id']);
      }
      else {
        self::make_attribute($attr, $question['id']);
      }

      if (!empty($deleted_attributes) && count($deleted_attributes) > 0) {
        foreach ($deleted_attributes as $deleted_attribute) {
          Question::delete_attribute($deleted_attribute);
        }
      }
    }
  }


  public static function make($question, $enquete_id) {
    global $db;
    $data = array(
        "question" => $question['question'],
        "order" => $question['order'],
        "required" => $question['required'],
        "Question_Types_id" => $db->select("SELECT id FROM Question_Types WHERE type = '{$question['type']}'")[0]['id'],
        "Enquetes_id" => $enquete_id
    );



    $db->insert("Questions", $data, "Enquetes_id = $enquete_id");
    $question_id = $db->lastInsertId();
    if (!empty($question['attributes']) && count($question['attributes']) > 0) {
      foreach ($question['attributes'] as $attr) {
        Self::make_attribute($attr, $question_id);
      }
    }
  }


  public static function delete($id) {
    global $db;
    $db->delete("Questions", " id = $id");
    $db->delete("Question_Attributes", " Questions_id = $id");
  }


  private static function make_attribute($attr, $question_id) {
    global $db;
    $data = array(
        "attribute" => $attr['attribute'],
        "Questions_id" => $question_id,
        "Question_Attribute_Types_id" => $db->select("SELECT id FROM Question_Attribute_Types WHERE attribute_type = '{$attr['type']}'")[0]['id']
    );
    $db->insert("Question_Attributes", $data);
  }


  private static function edit_attribute($attr, $question_id) {
    global $db;
    $data = array(
        "attribute" => $attr['attribute'],
        "Questions_id" => $question_id,
        "Question_Attribute_Types_id" => $db->select("SELECT id FROM Question_Attribute_Types WHERE attribute_type = '{$attr['type']}'")[0]['id']
    );
    $db->update("Question_Attributes", $data, "id = {$attr['id']}");
  }


  private static function delete_attribute($attr_id) {
    global $db;
    $db->delete("Question_Attributes", "id = $attr_id");
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
