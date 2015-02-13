<?php
$user_status = array(
  'admin' => 'admin',
  'user' => 'user'
);

$name = array(
  //'long' => 'Best-Buy-Books',
  //'short' => '3-B'
  'long' => 'Titan Entertainment',
  'short' => 'TE'
);

$project_root_parts = explode('/', $_SERVER['SCRIPT_NAME']);
$project_root = $project_root_parts[1] . '/'
                . ((substr($project_root_parts[2], -4) == '.php'
                    || $project_root_parts[2] == 'admin') ?
                  '' : $project_root_parts[2] . '/');

$project_root = $_SERVER['REQUEST_SCHEME'] . '://'
                  . $_SERVER['SERVER_NAME'] . '/'
                      . $project_root;

$admin_root = $project_root . "admin/";

$locations = array(
  'styles' => $admin_root . 'css/',
  'main_style' => $admin_root . 'css/styles.css',
  'scripts' => $admin_root . 'js/',
  'lib' => $admin_root . 'lib/',
  'home' => $project_root . 'index.php',
  'cart' => $project_root . 'cart.php',
  'admin' => $project_root . 'admin.php',
  'register' => $project_root . 'register.php',
  'login' => $project_root . 'login.php',
  'logout' => $admin_root . 'php/logout.php',
  'search' => $project_root . 'search.php'
);
?>
