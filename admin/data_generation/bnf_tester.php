<?php
  require_once '../php/connection.php';
  require_once 'word_loader.php';
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
  $bnf->add_word('semicolon', new Punctuation(';'));
  
  // rules
  $bnf->add_symbol('end_marker', '$end_marker };sentence_start');
  $bnf->add_symbol('common_noun', '$article $noun');
  $bnf->add_symbol('common_noun', '$article $adjective $noun');
  $bnf->add_symbol('thing', '#common_noun');
  $bnf->add_symbol('thing', '{is_proper;is_single $proper_noun }');
  $bnf->add_symbol('subject', '{is_subject #thing }', 2);
  //$bnf->add_symbol('subject', '{is_subject #thing #parenthetical }');
  //$bnf->add_symbol('subject', '{is_subject #list } {is_plural');
  $bnf->add_symbol('object', '{!is_subject #thing }');
  $bnf->add_symbol('list', '#thing {!is_subject and #thing }', 2);
  $bnf->add_symbol('list', '#thing {!is_subject $comma #list }');

  $bnf->add_symbol('tense', '{is_past');
  $bnf->add_symbol('tense', '{', 2);
  
  $bnf->add_symbol('parenthetical', '{!is_subject $comma #thing $comma }');
  
  $bnf->add_symbol('independent_clause', '#subject $verb #object', 4);
  $bnf->add_symbol('independent_clause', '#subject /be $adjective', 6);

  $bnf->add_symbol('statement', '#tense {sentence_start #independent_clause #end_marker } }', 4);
  $bnf->add_symbol('statement', '#tense {sentence_start #independent_clause $comma and #independent_clause #end_marker } }');
  $bnf->add_symbol('statement', '#tense {sentence_start #independent_clause $semicolon however $comma #independent_clause #end_marker } }');

  $bnf->add_symbol('pros', "{sentence_start pros:\n<ul> #pros_list </ul> }");
  $bnf->add_symbol('cons', "{sentence_start cons:\n<ul> #cons_list </ul> }");
  
  $bnf->add_symbol('cons_list', '#pros_list');
  $bnf->add_symbol('pros_list', '<li> #statement </li>');
  $bnf->add_symbol('pros_list', '<li> #statement </li> #pros_list');
  
  
  $bnf->add_symbol('statement_list', '#statement', 2);
  $bnf->add_symbol('statement_list', '#statement_list #statement');
  $bnf->add_symbol('review', '#statement_list');
  $bnf->add_symbol('review', "#pros \n #cons");
  print($bnf->generate('#review'));
  
?>