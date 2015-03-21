<?php 
require_once 'word_type.php';

class Adjective extends Word_Type {
  
  function __construct($data) {
    parent::__construct($data['base']);
  }
  
  public function evaluate($context) {
    return $this->base;
  }
  
}

?>