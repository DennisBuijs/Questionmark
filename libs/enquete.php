<?php

class Enquete {

  public $id, $name, $introduction, $creation_date, $start_date, $end_date, $questions;

  public function __construct() {
    $this->init();
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


  private function init() {
    global $db;
    $sql = "SELECT * FROM Enquetes WHERE id = :id";
    $data = $db->select($sql, array(":id" => $this->id));
    // $this->name = $data["name"];
    // $this->introduction = $data["introduction"];
    // $this->creation_date = $data["creation_date"];
    // $this->questions = $data["questions"];
    // print_r($this);
    // TODO: data uit database moet object eigenschap worden
  }


}

// echo "<pre>";
$enquete = Enquete::get_all();
// print_r($enquete);
