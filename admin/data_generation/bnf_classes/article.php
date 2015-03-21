<?php 
require_once 'word_type.php';

abstract class Article extends Word_Type {
  
  function __construct($marker) {
    parent::__construct($marker);
  }
  
}

?>