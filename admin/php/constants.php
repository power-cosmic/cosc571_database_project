<?php 
  $user_status = array(
      'admin'=>'admin',
      'user'=>'user'
  );
  
  $project_root = explode('/admin/', $_SERVER['SCRIPT_NAME'])[0];
  
  $locations = array(
      'main_style'=> 'admin/css/styles.css',
      'home'=> $project_root
  );
?>