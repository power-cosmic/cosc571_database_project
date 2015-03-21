<?php 
require_once 'article.php';

class The extends Article {
  
  function __construct() {
    parent::__construct('the');
  }
  
  public function evaluate($context) {
    return $this->base;
  }
  
}

?>