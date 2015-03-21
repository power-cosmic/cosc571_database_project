<?php 
require_once 'i.php';
require_once 'verb.php';

class Be extends Verb {
  
  function __construct() {
    parent::__construct([
      'base' => 'be',
      'past' => 'was'
    ]);
  }
  
  public function evaluate($context) {
    
    // handle the special cases
    if ($context->is_plural) {
      if($context->is_past) {
        return 'were';
      } else {
        return 'are';
      }
    } elseif ($context->subject instanceof I) {
      return 'am';
    } elseif (!$context->is_past) {
      return 'is';
      return parent::evaluate($context);
    }
    
  }
  
}

?>