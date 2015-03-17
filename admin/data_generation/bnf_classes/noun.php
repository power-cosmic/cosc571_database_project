<?php

require_once 'word_type.php';

class Noun extends Word_Type {
  
  private $plural;
  private $is_proper;
  private $is_abstract;
  
  function __construct($data) {
    parent::__construct($data['base']);
        
    // if there's a special plural, use it
    if ($data['plural'] != null) {
      $this->plural = $data['plural'];
    } else {
      $this->plural = $data['base'] . 's';
    }

    // get other basic info
    $this->is_proper = $data['is_proper'];
    $this->is_abstract = $data['is_abstract'];

  }
  
  public function evaluate($context) {
    
    // main word
    if (!$context->is_plural || $context->is_abstract) {
      $output = $this->base;
    } else {
      $output = $this->plural;
    }
    return $output;
  }
  
}

?>