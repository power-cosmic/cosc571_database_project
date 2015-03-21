<?php 
require_once 'article.php';
require_once 'letter_analyzer.php';

class A extends Article {
  
  function __construct() {
    parent::__construct('a');
  }
  
  public function evaluate($context) {
    $next_word = $context->next_word;
    if ($context->is_plural) {
      return 'some';
    } elseif (!is_null($next_word)) {
      if (is_vowel(substr($next_word->base, 0, 1))) {
        return 'an';
      }
    }
    
    return $this->base;
  }
  
}

?>