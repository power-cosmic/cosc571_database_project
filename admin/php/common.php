<?php
  include_once 'constants.php';

  function createBasicHead($title = '', $script_location = null, $styles = []) {

    $toReturn = '<head>
    <title>' . $GLOBALS['name']['short'] . ' | ' . $title . '</title>
    <link rel="stylesheet" type="text/css" href="' . $GLOBALS['locations']['main_style'] . '">';
    
    foreach($styles as $style) {
      $toReturn .= '<link rel="stylesheet" type="text/css" href="' . $GLOBALS['locations']['styles'] . $style . '">';
    }
    
    if ($script_location) {
      $toReturn .= '<script src="' . $GLOBALS['locations']['lib'] . 'require.js"></script>
          <script>
            require.config({
              paths: {
                lib: "' . $GLOBALS['admin_root'] . 'lib",
                js: "' . $GLOBALS['admin_root'] . 'js"
              }
            });
            require(["js/' . $script_location . '"]);
            </script>';
    }

    $toReturn .= '</head>';

    return $toReturn;
  }
  
?>
