<?php

class Context {
  public $is_plural;
  public $is_specific;
  
  function __construct() {
    $this->is_plural = false;
    $this->is_specific = false;
  }
}

?>