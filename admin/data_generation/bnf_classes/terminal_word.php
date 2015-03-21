<?php 
require_once 'word_type.php';

class Terminal_Word extends Word_Type {
  
  function __construct($word) {
    parent::__construct($word);
  }
  
  public function evaluate($context) {
    return $this->base;
  }
  
}

?>