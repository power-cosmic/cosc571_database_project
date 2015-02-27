<?php
  require_once 'bnf_engine.php';
  
  $db = open_connection('data_generator');
  $word_database = [];
  $word_database['transitive_verb'] = get_words(
      $db,
      'SELECT * FROM verbs WHERE is_transitive=1 ORDER BY RAND();',
      'verb'
  );
  $word_database['intransitive_verb'] = get_words(
      $db,
      'SELECT * FROM verbs WHERE is_transitive=0 ORDER BY RAND();',
      'verb'
  );
  $word_database['noun'] = get_words(
      $db,
      'SELECT * FROM nouns ORDER BY RAND();',
      'noun'
  );
  $word_database['adjective'] = get_words(
      $db,
      'SELECT * FROM adjectives ORDER BY RAND();',
      'adjective'
  );
  $word_database['book'] = 'The Fellowship of the Rings';
  $word_database['author'] = 'J. R. R. Tolkien';
  $word_database['article'] = ['a', 'the'];
  
  $review_symbols = array(
      'review' => [
          '#statement_list', 
          '#statement_list', 
          '#statement_list #pros_cons',
          '#pros-cons #statement_list'
      ],
      'pros_cons' => ["<br/>pros:<br/> #statement_list <br/>cons:<br/> #statement_list"],
      'statement_list' => ['#statement', '#statement #statement_list'],
      'statement' => [
        '#subject is $adjective .',
        '#subject $transitive_verb #object .',
        '#subject $intransitive_verb .'
      ],
      'thing' => ['$article $noun', '$article $noun', '$author', '$book', 'this'],
      'subject' => ['I', 'he', 'she', 'they', '#thing', '#thing', '#thing'],
      'object' => ['me', 'him', 'her', 'them', '#thing', '#thing', '#thing']
  );
  
  $output = generate($review_symbols, $word_database, '#review');
  print($output);
?>