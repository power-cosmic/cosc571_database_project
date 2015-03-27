<?php

class Context {
  
  public $subject;
  public $is_plural;
  public $is_specific;
  public $is_subject;
  public $is_past;
  public $next_word;
  public $is_first_word;
  public $is_end;
  public $sentence_start;
  
  function __construct() {
    $this->subject = null;
    $this->is_plural = false;
    $this->is_specific = false;
    $this->is_subject = false;
    $this->is_end = false;
    $this->is_first_word = true;
    $this->is_past = false;
    $this->next_word = null;
    $this->sentence_start = true;
  }
  
  public function set($changer) {

    $changes = explode(';', $changer);
      foreach ($changes as $change) {
      if (strlen($change) > 0) {
        if (substr($change, 0, 1) == '!') {
          $this->{substr($change, 1)} = false;
        } else {
          $this->$change = true;
        }
      }
    }
    
  }
  
}

?>