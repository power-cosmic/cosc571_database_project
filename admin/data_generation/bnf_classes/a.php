<?php 
require_once 'letter_analyzer.php';
require_once 'word_type.php';

class A extends Word_Type {
  
  function __construct() {
    parent::__construct('a');
  }
  
  public function evaluate($context) {
    
    $next_word = $context->next_word;
    if (!is_null($next_word)) {
       if (is_vowel(substr($next_word, 0, 1))) {
         return 'an';
       }
    }
    
    return $this->base;
  }
  
}

?>