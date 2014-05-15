<?php

class Question {

  public $question, $type, $attributes, $required, $order;

  public function __construct($id) {
    $this->init($id);
  }


  /**
   * Initializes question object
   * @param int $id Id of the question
   */
  private function init($id) {
    $this->id = $id;
    $this->question = $this->get_question();
    $this->attributes = $this->get_attributes();
    $this->type = $this->get_type();
    $this->order = $this->get_order();
    $this->required = $this->get_required();
  }


  /**
   * Edits a question
   * @global object $db Database object used to communicate with MySQL database
   * @param array $question
   * @param array $deleted_attributes the ids of the deleted attributes
   */
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


  /**
   * Makes question
   * @global object $db Database object used to communicate with MySQL database
   * @param array $question
   * @param int $enquete_id The id of the enquete
   */
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


  /**
   * Deletes question 
   * @global object $db Database object used to communicate with MySQL database
   * @param int $id The id of the question
   */
  public static function delete($id) {
    global $db;
    $db->delete("Questions", " id = $id");
    $db->delete("Question_Attributes", " Questions_id = $id");
  }


  /**
   * Makes attribute
   * @global object $db Database object used to communicate with MySQL database
   * @param array $attr 
   * @param id $question_id Id of the question
   */
  private static function make_attribute($attr, $question_id) {
    global $db;
    $data = array(
        "attribute" => $attr['attribute'],
        "Questions_id" => $question_id,
        "Question_Attribute_Types_id" => $db->select("SELECT id FROM Question_Attribute_Types WHERE attribute_type = '{$attr['type']}'")[0]['id']
    );
    $db->insert("Question_Attributes", $data);
  }


  /**
   * Edits attribute
   * @global object $db Database object used to communicate with MySQL database
   * @param array $attr 
   * @param int $question_id Id of the question
   */
  private static function edit_attribute($attr, $question_id) {
    global $db;
    $data = array(
        "attribute" => $attr['attribute'],
        "Questions_id" => $question_id,
        "Question_Attribute_Types_id" => $db->select("SELECT id FROM Question_Attribute_Types WHERE attribute_type = '{$attr['type']}'")[0]['id']
    );
    $db->update("Question_Attributes", $data, "id = {$attr['id']}");
  }


  /**
   * Delete attribute
   * @global object $db Database object used to communicate with MySQL database
   * @param int $attr_id Id of the attribute
   */
  private static function delete_attribute($attr_id) {
    global $db;
    $db->delete("Question_Attributes", "id = $attr_id");
  }


  /**
   * Gets question by enqeute id
   * @global object $db Database object used to communicate with MySQL database
   * @param int $id Id of the enqeute
   * @return self
   */
  public static function get_questions_by_enquete_id($id) {
    global $db;

    $sql = "SELECT id FROM Questions WHERE Enquetes_id = :id ORDER BY `order` ASC";
    $data = $db->select($sql, array(":id" => $id));

    $questions = '';
    foreach ($data as $key => $value) {
      $questions[] = new self($value['id']);
    }
    return $questions;
  }


  /**
   * Gets question by id
   * @param int $id Id of the question
   * @return \self
   */
  public function get_question_by_id($id) {
    return new self($id);
  }


  /**
   * Gets question
   * @global object $db Database object used to communicate with MySQL database
   * @return string Question
   */
  private function get_question() {
    global $db;
    $sql = "SELECT question FROM Questions where id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['question'];
  }


  /**
   * Gets question type
   * @global object $db Database object used to communicate with MySQL database
   * @return string question type
   */
  private function get_type() {
    global $db;
    $sql = "SELECT Question_Types.type "
            . "FROM Question_Types, Questions "
            . "WHERE Questions.Question_Types_id = Question_Types.id "
            . "AND Questions.id = :id";

    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['type'];
  }


  /**
   * Gets question attribuets
   * @global object $db Database object used to communicate with MySQL database
   * @return array attributes
   */
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


  /**
   * Gets order
   * @global object $db Database object used to communicate with MySQL database
   * @return int The order
   */
  private function get_order() {
    global $db;
    $sql = "SELECT `order` FROM Questions WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['order'];
  }


  /**
   * checks if question is required
   * @global object $db Database object used to communicate with MySQL database
   * @return bool
   */
  private function get_required() {
    global $db;
    $sql = "SELECT `required` FROM Questions WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    return $data[0]['required'];
  }


}
