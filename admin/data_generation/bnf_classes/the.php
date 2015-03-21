<?php 
require_once 'word_type.php';

class The extends Word_Type {
  
  function __construct() {
    parent::__construct('the');
  }
  
  public function evaluate($context) {
    return $this->base;
  }
  
}

?>