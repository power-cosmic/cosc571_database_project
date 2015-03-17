<?php
  require_once '../php/connection.php';
  require_once 'bnf_classes/context.php';
  require_once 'bnf_classes/i.php';
  
  class BNF_Engine {
    
    private $word_database;
    private $symbol_table;
    
    function __construct() {
      $this->word_database = [];
      $this->symbol_table = [];
      $this->context = new Context();
    }

    public function generate($symbol_name) {
      $list = $this->generate_next($symbol_name, []);
      return $this->evaluate($list);
    }
    
    public function add_word($type, $word) {
      
      // add type if needed
      if ($this->word_database[$type] == null) {
        $this->word_database[$type] = [];
      }
      array_push($this->word_database[$type], $word);
    }
    
    public function add_symbol($symbol, $expression) {

      // add symbol if needed
      if ($this->symbol_table[$symbol] == null) {
        $this->symbol_table[$symbol] = [];
      }

      array_push($this->symbol_table[$symbol], $expression);
    }
    
    /**
     * Generate an expression using bnf.
     * Do not call this directly; used by generate()
     * @param String $symbol_name Symbol name | terminal | variable name from $wordDatabase
     * @return string
     */
    private function generate_from_symbols($symbol_name, $list) {
      
      $choices = $this->symbol_table[$symbol_name];
      $index = rand(0, sizeof($choices) - 1);
      $choice = $choices[$index];
      $expressions = explode(' ', $choice);

      foreach ($expressions as $expression) {
        $list = $this->generate_next($expression, $list);
      }
      
      return $list;
    }
    
    /**
     * Get a word from the database.
     * Do not call this directly; used by generate()
     * @param String $symbol_name Identifier
     * @return String
     */
    private function generate_from_database($symbol_name, $list) {
      $group = $this->word_database[$symbol_name];
      $index = rand(0, count($group) - 1);
      $choice = $group[$index];
      array_push($list, $group[$index]);
      return $list;
    }
    
    
    /**
     * Generate stuff using bnf and word bank.
     * Check the cases for detail on how $symbol_name is handled
     * Call this once using $symbol_name as the starting symbol
     * @param unknown $symbol_name Identifier
     * @return string
     */
    private function generate_next($symbol_name, $list) {
      
      switch(substr($symbol_name, 0, 1)) {
        # from database arrays
        case '$':
          $database_id = substr($symbol_name, 1);
          $list = $this->generate_from_database($database_id, $list);
          break;
          
        # from symbol table
        case '#':
          $symbol_id = substr($symbol_name, 1);
          $list = $this->generate_from_symbols($symbol_id, $list);
          break;
          
        # terminal
        default:
          array_push($list, $symbol_name);
      }
      return $list;
    }
    
    public function evaluate($list) {
      $context = new Context();
      $context->is_subject = true;
      
      $output = '';
      foreach ($list as $word) {
        
        // update context
        if ($word instanceof Noun) {
          $context->subject = $word;
        } elseif ($word instanceof Verb) {
          $context->is_subject = false;
        }
        
        $output .= $word->evaluate($context) . ' ';
      }
      
      return $output;
    }
  }
?>