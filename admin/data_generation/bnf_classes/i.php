<?php
require_once 'noun.php';

class I extends Noun {
  
  function __construct() {
    $data = [
      'base' => 'I',
      'plural' => 'we',
      'is_proper' => true
    ];
    parent::__construct($data);
  }
  
  public function evaluate($context) {
    if ($context->is_subject) {
      return parent::evaluate($context);
    } elseif ($context->is_plural) {
      return 'us';
    } elseif ($context->subject instanceof I) {
      return 'myself';
    } else {
      return 'me';
    }
  }
  
}

?>