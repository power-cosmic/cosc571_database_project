<?php 
require_once 'bnf_classes/article.php';
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
    $context = $this->context_peek();
    array_push($this->word_context_pairs, [
      'word' => $word,
      'context' => $context
    ]);
    
    if ($context->sentence_start || $context->is_first_word) {
      $context = clone $context;
      $change = '';
      
      if ($context->sentence_start && $context->is_first_word) {
        $change = '!sentence_start;!is_first_word';
      }
      elseif ($context->sentence_start) {
        $change .= '!sentence_start';
      } else {
        $change .= '!first_word';
      }
      
      
      $context->set($change);
      $this->push_context($context);
    }
    
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
  
  function peek_next_word() {
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