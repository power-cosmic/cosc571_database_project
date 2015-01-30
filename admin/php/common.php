<?php
  include_once 'constants.php';

  function createBasicHead($title = '3-B.com', $scripts = [], $styles = []) {

    $toReturn = '<head>
    <title>'.$title.'</title>
    <link rel="stylesheet" type="text/css" href="'.$GLOBALS['locations']['main_style'].'">';
    
    foreach($styles as $style) {
      $toReturn .= '<link rel="stylesheet" type="text/css" href="'.$style.'">';
    }
    
    foreach($scripts as $script) {

        $toReturn .= '<script src="'.$script.'"></script>';

    }

    $toReturn .= '</head>';

    return $toReturn;
  }
  
?>
