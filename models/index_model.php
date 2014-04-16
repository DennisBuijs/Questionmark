<?php

class Index_Model extends Model {

  public function get_seo() {
    return array('title' => 'Questionmark?');
  }


  public function get_all_enquetes() {
    return Enquete::get_all();
  }


}
