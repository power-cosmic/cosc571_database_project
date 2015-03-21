<?php 
require_once 'word_type.php';

class End_Marker extends Word_Type {
  
  function __construct($marker) {
    parent::__construct($marker);
  }
  
  public function evaluate($context) {
    return $this->base;
  }
  
}

?>