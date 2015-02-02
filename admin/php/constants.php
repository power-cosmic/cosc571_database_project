<?php 
  $user_status = array(
      'admin'=>'admin',
      'user'=>'user'
  );
 
  $project_root = explode('/', $_SERVER['SCRIPT_NAME'])[0];
  if (strlen($project_root)) {
    $project_root.="/";
  }
  
  $admin_root = $project_root."admin/";
  
  $locations = array(
      'main_style'=> $admin_root.'css/styles.css',
      'scripts'=> $admin_root.'js/',
      'lib'=> $admin_root.'lib/',
      'home'=> $project_root.'index.php',
      'cart'=> $project_root.'cart.php',
      'admin'=> $project_root.'admin.php',
      'register'=> $project_root.'register.php',
      'login'=> $project_root.'login.php'
  );
?>