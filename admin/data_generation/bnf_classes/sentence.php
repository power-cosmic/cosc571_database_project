<?php 
require_once 'bnf_classes/context.php';

class Sentence implements Iterator {
  
  private $word_context_pairs;
  private $context_stack;
  private $position;
  
  function __construct() {
    $this->word_context_pairs = [];
    $this->context_stack = [new Context()];
    $this->rewind();
  }
  
  public function push_word($word) {
    array_push($this->word_context_pairs, [
      'word' => $word,
      'context' => $this->context_peek()
    ]);
  }
  
  public function push_context($context) {
    array_push($this->context_stack, $context);
  }
  
  public function pop_context() {
    array_shift($this->context_stack);
  }
  
  public function length() {
    return count($this->word_context_pairs);
  }
  
  function next() {
    ++$this->position;
  }
  
  function current() {
    return $this->word_context_pairs[$this->position];
  }
  
  function rewind() {
    $this->position = 0;
  }
  
  function key() {
    return $this->position;
  }
  
  function valid() {
    return isset($this->word_context_pairs[$this->position]);
  }
  
  function peek_next() {
    if (isset($this->word_context_pairs[$this->position + 1])) {
      return $this->word_context_pairs[$this->position + 1]['word'];
    }
    return NULL;
  }
  
  function context_peek() {
    $top = end($this->context_stack);
    reset($this->context_stack);
    return $top;
  }
  
}

?>