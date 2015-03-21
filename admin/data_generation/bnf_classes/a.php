<?php 
require_once 'article.php';
require_once 'letter_analyzer.php';

class A extends Article {
  
  function __construct() {
    parent::__construct('a');
  }
  
  public function evaluate($context) {
    $next_word = $context->next_word;
    if (!is_null($next_word)
        && is_vowel(substr($next_word, 0, 1))) {
     return 'an';
    }
    
    return $this->base;
  }
  
}

?>