<?php
  require_once '../php/connection.php';
  require_once 'bnf_classes/context.php';
  require_once 'bnf_classes/i.php';
  require_once 'bnf_classes/noun.php';
  require_once 'bnf_classes/punctuation.php';
  require_once 'bnf_classes/sentence.php';
  require_once 'bnf_classes/terminal_word.php';
  
  class BNF_Engine {
    
    private $word_database;
    private $symbol_table;
    
    function __construct() {
      $this->word_database = [];
      $this->symbol_table = [];
      $this->context = new Context();
    }

    public function generate($symbol_name) {
      $sentence = new Sentence();
      $sentence = $this->generate_next($symbol_name, $sentence);
      return $this->evaluate($sentence);
    }
    
    public function add_word($type, $word, $frequency = 1) {
      
      // add type if needed
      if ($this->word_database[$type] == null) {
        $this->word_database[$type] = [];
      }
      
      for ($i = 0; $i < $frequency; $i++) {
        array_push($this->word_database[$type], $word);
      }
    }
    
    public function add_symbol($symbol, $expression, $frequency = 1) {

      // add symbol if needed
      if ($this->symbol_table[$symbol] == null) {
        $this->symbol_table[$symbol] = [];
      }
      for ($i = 0; $i < $frequency; $i++) {
        array_push($this->symbol_table[$symbol], $expression);
      }
    }
    
    /**
     * Generate an expression using bnf.
     * Do not call this directly; used by generate()
     * @param String $symbol_name Symbol name | terminal | variable name from $wordDatabase
     * @return string
     */
    private function generate_from_symbols($symbol_name, $sentence) {
      $choices = $this->symbol_table[$symbol_name];
      $index = rand(0, sizeof($choices) - 1);
      $choice = $choices[$index];
      $expressions = explode(' ', $choice);
      foreach ($expressions as $expression) {
        $sentence = $this->generate_next($expression, $sentence);
      }
      
      return $sentence;
    }
    
    private function generate_word($word_id, $sentence) {
      $word = $this->get_word($word_id);
      $sentence->push_word($word);
      return $sentence;
    }
    
    private function get_word($literal) {
      foreach ($this->word_database as $type) {
        foreach ($type as $word) {
          if ($literal == $word->base) {
            return $word;
          }
        }
      }
    }
    
    /**
     * Get a word from the database.
     * Do not call this directly; used by generate()
     * @param String $symbol_name Identifier
     * @return String
     */
    private function generate_from_database($symbol_name, $sentence) {
      $group = $this->word_database[$symbol_name];
      $index = rand(0, count($group) - 1);
      $word = $group[$index];
      
      $context = $sentence->context_peek();
      if ($context->is_subject && $word instanceof Noun) {
        $context->subject = $word;
      }
      
      $sentence->push_word($word);
      return $sentence;
    }
    
    private function push_context($context_changer, $sentence) {
      
      $new_context = clone $sentence->context_peek();
      
      $new_context->set($context_changer);
      $sentence->push_context($new_context);
      return $sentence;
    }
    
    /**
     * Generate stuff using bnf and word bank.
     * Check the cases for detail on how $symbol_name is handled
     * Call this once using $symbol_name as the starting symbol
     * @param unknown $symbol_name Identifier
     * @return string
     */
    private function generate_next($symbol_name, $sentence) {
      
      switch(substr($symbol_name, 0, 1)) {
        # from database arrays
        case '$':
          $database_id = substr($symbol_name, 1);
          $this->generate_from_database($database_id, $sentence);
          break;
          
        # from symbol table
        case '#':
          $symbol_id = substr($symbol_name, 1);
          $this->generate_from_symbols($symbol_id, $sentence);
          break;

        case '/':
          $word_id = substr($symbol_name, 1);
          $this->generate_word($word_id, $sentence);
          break;
            
        case '>':
          $context_id = substr($symbol_name, 1);
          $sentence = $this->push_context($context_id, $sentence);
          break;
          
        case '<':
          $context_id = substr($symbol_name, 1);
          $sentence->pop_context();
          break;
          
        # terminal
        default:
          $sentence->push_word(new Terminal_Word($symbol_name));
      }
      
      return $sentence;
    }
    
    public function evaluate($sentence) {
      $output = '';
      foreach ($sentence as $word_context_pair) {
        
        $word = $word_context_pair['word'];
        $context = $word_context_pair['context'];
        $new_word = $word->evaluate($context);
        
        // add a space if needed
        if (!$context->is_first_word && !($word instanceof Punctuation)) {
          $output .= ' ';
        }
        
        // capitalize if needed
        if ($context->sentence_start) {
          $new_word = ucfirst($new_word);
        }
        $output .= $new_word;
      }
      
      return $output;
    }
  }
?>