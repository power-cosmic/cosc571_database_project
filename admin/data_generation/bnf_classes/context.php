<?php

class Context {
  public $is_plural;
  public $is_specific;
  public $is_subject;
  
  function __construct() {
    $this->is_plural = false;
    $this->is_specific = false;
    $this->is_subject = false;
  }
}

?>