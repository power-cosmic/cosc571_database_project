<?php
abstract class Word_Type {
  
  public $base;
  
  function __construct($base) {
     $this->base = $base;
  }
  
  abstract public function evaluate($context);
  
}

?>