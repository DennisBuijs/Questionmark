<?php

class Index_Model extends Model {

  public function get_seo() {
    return array('title' => 'Questionmark :: Vraag uw klant!!');
  }


  public function get_all_enquetes() {
    return array(
        array("name" => "Enquete 1", "description" => "lorem ipsum bladiebladiebla", "questions" => array()),
        array("name" => "Enquete 2", "description" => "lorem ipsum bladiebladiebla", "questions" => array())
    );
  }


}
