<?php

class Index_Model extends Model {

  /**
   * Gets enqeute by id
   * @return array All Equetes
   */
  public function get_all_enquetes() {
    return Enquete::get_all();
  }


}
