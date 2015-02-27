<?php
  require_once '../php/connection.php';
  
  /**
   * Generate an array of words from a database
   * @param unknown $db Database to use
   * @param unknown $query Query to run
   * @param unknown $field Field to select
   * @return Array of words
   */
  function get_words($db, $query, $field) {
    $words = [];
    $stmt = $db->prepare($query);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($words, $row[$field]);
    }
    return $words;
  }
  
  /**
   * Generate an expression using bnf.
   * Do not call this directly; used by generate()
   * @param unknown $symbol_table The symbol table
   * @param unknown $word_database A word database
   * @param unknown $symbol_name Symbol name | terminal | variable name from $wordDatabase
   * @return string
   */
  function generate_from_bnf($symbol_table, $word_database, $symbol_name) {
    $choices = $symbol_table[$symbol_name];
    $index = rand(0, sizeof($choices) - 1);
    $choice = $choices[$index];
    $expressions = explode(' ', $choice);
    
    $output = '';
    foreach ($expressions as $expression) {
      $output .= generate($symbol_table, $word_database, $expression);
    }
    return $output;
  }
  
  /**
   * Get a word from the database.
   * Do not call this directly; used by generate()
   * @param unknown $word_database Word database
   * @param unknown $symbol_name Identifier
   * @return string
   */
  function generate_from_database($word_database, $symbol_name) {
    $choice = $word_database[$symbol_name];
    
    if (gettype($choice) == 'string') {
      return $choice;
    } else {
      $index = rand(0, sizeof($choice) - 1);
      return $choice[$index];
    }
  }
  
  /**
   * Generate stuff using bnf and word bank.
   * Check the cases for detail on how $symbol_name is handled
   * Call this once using $symbol_name as the starting symbol
   * @param unknown $symbol_table BNF table
   * @param unknown $word_database Word bank
   * @param unknown $symbol_name Identifier
   * @return string
   */
  function generate($symbol_table, $word_database, $symbol_name) {
    $output = '';
    switch(substr($symbol_name, 0, 1)) {
      # from database arrays
      case '$':
        $database_id = substr($symbol_name, 1);
        $output = generate_from_database($word_database, $database_id);
        break;
        
      # from symbol table
      case '#':
        $symbol_id = substr($symbol_name, 1);
        $output = generate_from_bnf($symbol_table, $word_database, $symbol_id);
        break;
        
      # terminal
      default:
        $output = $symbol_name;
    }
    return $output . ' ';
  }
  
?>