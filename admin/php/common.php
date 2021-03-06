<?php
include_once 'admin/php/book_info.php';
include_once 'admin/php/cart.php';
include_once 'admin/php/login.php';
include_once 'constants.php';

function createBasicHead($title = '', $script_location = null, $styles = [], $no_css = false) {
  $toReturn = '<head>
    <title>' . $GLOBALS['name']['short'] . ' | ' . $title . '</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="'. $GLOBALS['locations']['favicon'] . '" />';
  
  if (!$no_css) {
    $toReturn .= '<link rel="stylesheet" type="text/css" href="' . $GLOBALS['locations']['main_style'] . '">';
  }
        
  foreach($styles as $style) {
    $toReturn .= '
    <link rel="stylesheet" type="text/css" href="' . $GLOBALS['locations']['styles'] . $style . '">';
  }

  $toReturn .= '
    <script src="' . $GLOBALS['locations']['lib'] . 'require.js"></script>
    <script>
      require.config({
        paths: {
          lib: "' . $GLOBALS['admin_root'] . 'lib",
          js: "' . $GLOBALS['admin_root'] . 'js"
        }
      });';
  if ($script_location) {
    if (is_array($script_location)) {
      $locations = '"js/' . $script_location[0] . '"';
      for ($i = 1; $i < count($script_location); $i++) {
        $locations .= ', "js/' . $script_location[$i] . '"';
      }
      $toReturn .= 'require([' . $locations . ']);';
    } else {
      $toReturn .= 'require(["js/' . $script_location . '"]);';
    }
  }
  $toReturn .= '
      require(["js/stickyHeader"]);
    </script>';

  $toReturn .= '
    </head>' . "\n";

  return $toReturn;
}
?>
