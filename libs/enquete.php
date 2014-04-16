<?php

class Enquete {

  public $id, $name, $introduction, $creation_date, $start_date, $end_date, $questions;

  public function __construct($id) {
    $this->init($id);
  }


  public static function get_all() {
    global $db;


    $sql = "SELECT id FROM Enquetes";
    $data = $db->select($sql);

    foreach ($data as $key => $value) {
      $enquetes[] = new self($value['id']);
    }
    
    return $enquetes;
  }


  public static function get_enquete_by_id($id) {
    return new self($id);
  }


  private function init($id) {
    global $db;
    $this->id = $id;

    $sql = "SELECT * FROM Enquetes WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));

    $this->name = $data[0]['name'];
    $this->introduction = $data[0]['introduction'];
    $this->creation_date = $data[0]['creation_date'];
    $this->start_date = $data[0]['start_date'];
    $this->end_date = $data[0]['end_date'];
    $this->questions = Question::get_questions_by_enquete_id();
  }


}
