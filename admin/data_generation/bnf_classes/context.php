<?php

class Context {
  
  public $subject;
  public $is_plural;
  public $is_specific;
  public $is_subject;
  public $is_past;
  
  
  function __construct() {
    $this->subject = null;
    $this->is_plural = false;
    $this->is_specific = false;
    $this->is_subject = false;
    $this->is_past = false;
  }
}

?>