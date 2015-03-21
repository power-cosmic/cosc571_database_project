<?php
require_once 'letter_analyzer.php';
require_once 'i.php';
require_once 'word_type.php';

class Verb extends Word_Type {
  
  private $past;
  private $present;
  private $gerund;
  
  function __construct($data) {
    parent::__construct($data['base']);
    $base = $data['base'];
    
    // past tense
    if ($data['past'] != null) {
      $this->past = $data['past'];
    } elseif (substr($base, -1) == 'e') {
      $this->past = $base . 'd';
    } else {
      $this->past = $base . 'ed';
    }
    
    // present tense
    $this->present = $base . 's';
    
    // gerund
    if (substr($base, -1) == 'e') {
      $this->gerund = substr($base, 0, strlen($base) - 1) . 'ing';
    } elseif ($this->double_last()) {
      $this->gerund = $base . substr($base, -1) . 'ing';
    } else {
      $this->gerund = $base . 'ing';
    }
  }
  
  public function evaluate($context) {
    if ($context->is_plural || $context->subject instanceof I) {
      return $this->base;
    } elseif ($context->is_past) {
      return $this->past;
    } else {
      return $this->present;
    }
  } 
  
  private function double_last() {
    $base = $this->base;
    return  is_vowel(!substr($base, -3, 1))
        && is_vowel(substr($base, -2, 1))
        && is_vowel(!substr($base, -1));
  }
  
}

?>