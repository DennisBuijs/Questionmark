<?php

class Index_Model extends Model {

  public function get_all_enquetes() {
    return Enquete::get_all();
  }


}
