<?php
  function createBasicHead($title = '3-B.com', $scripts = [], $styles = []) {

    $toReturn = '<head>
    <title>'.$title.'</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">';
    
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

