<?php
  require_once 'bnf_engine.php';
  
  $db = open_connection('data_generator');
  $word_database = [];
  $word_database['first_names'] = get_words(
      $db,
      'SELECT * FROM first_name ORDER BY RAND();',
      'first_name'
  );
  $word_database['last_names'] = get_words(
      $db,
      'SELECT * FROM last_name ORDER BY RAND();',
      'last_name'
  );
  
  $author_symbols = array(
      'full_name' => ['#first_name #last_name'],
      'first_name' => ['$first_names'],
      'last_name' => ['$last_names']
  );
  
  $output = generate($author_symbols, $word_database, '#full_name');
  print($output);
?>