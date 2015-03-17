<?php
  require_once '../php/connection.php';
  require_once 'bnf_engine.php';
  require_once 'bnf_classes/context.php';
  require_once 'bnf_classes/i.php';
  require_once 'bnf_classes/noun.php';
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
      'SELECT * FROM nouns ORDER BY RAND();'
  );

  // create engine
  $bnf = new BNF_Engine();
  foreach ($verbs as $verb) {
    $bnf->add_word('verb', new Verb($verb));
  }
  foreach ($nouns as $noun) {
    $bnf->add_word('noun', new Noun($noun));
  }

  // special words
  $bnf->add_word('noun', new I());

  $bnf->add_symbol('review', '$noun $verb');
  $bnf->add_symbol('review', '$noun $verb $noun');
  print($bnf->generate('#review'));
  
?>