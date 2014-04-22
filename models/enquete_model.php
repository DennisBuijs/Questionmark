<?php

class Enquete_Model extends Model {

  public function get_enquete_by_id($id) {
    return Enquete::get_enquete_by_id($id);
  }


  public function delete($id) {
    Enquete::delete($id);
  }


}
