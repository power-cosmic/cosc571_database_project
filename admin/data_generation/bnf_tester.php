<?php
  require_once '../php/connection.php';
  require_once 'bnf_engine.php';
  require_once 'bnf_classes/a.php';
  require_once 'bnf_classes/adjective.php';
  require_once 'bnf_classes/be.php';
  require_once 'bnf_classes/context.php';
  require_once 'bnf_classes/punctuation.php';
  require_once 'bnf_classes/i.php';
  require_once 'bnf_classes/noun.php';
  require_once 'bnf_classes/the.php';
  require_once 'bnf_classes/verb.php';
  require_once 'bnf_classes/word_type.php';
  
  /**
   * Generate an array of words from a database
   * @param unknown $db Database to use
   * @param unknown $query Query to run
   * @param unknown $field Field to select
   * @return Array of words
   */
  function get_words($db, $query) {
    $words = [];
    $stmt = $db->prepare($query);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($words, $row);
    }
    return $words;
  }
  
  $db = open_connection('bnf_generator');
  
  // fetch words from db
  $verbs = get_words(
      $db,
      'SELECT * FROM verbs ORDER BY RAND();'
  );
  $nouns = get_words(
      $db,
      'SELECT * FROM nouns WHERE is_proper = FALSE ORDER BY RAND();'
  );
  
  $proper_nouns = get_words(
      $db,
      'SELECT * FROM nouns WHERE is_proper = TRUE ORDER BY RAND();'
  );
  
  $adjectives = get_words(
      $db,
      'SELECT * FROM adjectives ORDER BY RAND();'
  );
  
  // create engine
  $bnf = new BNF_Engine();
  foreach ($verbs as $verb) {
    $bnf->add_word('verb', new Verb($verb));
  }
  foreach ($nouns as $noun) {
    $bnf->add_word('noun', new Noun($noun));
  }
  foreach ($proper_nouns as $noun) {
    $bnf->add_word('proper_noun', new Noun($noun));
  }
  foreach ($adjectives as $adjective) {
    $bnf->add_word('adjective', new Adjective($adjective));
  }
  
  // special words
  $bnf->add_word('proper_noun', new I());
  $bnf->add_word('verb', new Be());
  $bnf->add_word('article', new A());
  $bnf->add_word('article', new The());
  
  // punctuation
  $bnf->add_word('end_marker', new Punctuation('.'), 3);
  $bnf->add_word('end_marker', new Punctuation('!'));
  $bnf->add_word('comma', new Punctuation(','));
  
  // rules
  $bnf->add_symbol('end_marker', '$end_marker >;sentence_start');
  $bnf->add_symbol('common_noun', '$article $noun');
  $bnf->add_symbol('common_noun', '$article $adjective $noun');
  $bnf->add_symbol('thing', '#common_noun');
  $bnf->add_symbol('thing', '>is_proper;!is_single $proper_noun');
  $bnf->add_symbol('subject', '>is_subject #thing');
  $bnf->add_symbol('subject', '>is_subject #list');
  $bnf->add_symbol('object', '>!is_subject #thing');
  $bnf->add_symbol('list', '#thing and #thing >is_plural', 2);
  $bnf->add_symbol('list', '#thing $comma #list');
  
  $bnf->add_symbol('statement', '>sentence_start;is_past #subject $verb #object #end_marker');
  $bnf->add_symbol('statement', '>sentence_start #subject $verb #object #end_marker');
  $bnf->add_symbol('statement', '>sentence_start #subject /be $adjective #end_marker');

  $bnf->add_symbol('statement_list', '#statement');
  $bnf->add_symbol('statement_list', '#statement_list #statement');
  $bnf->add_symbol('review', '#statement_list');
  print($bnf->generate('#review'));
  
?>