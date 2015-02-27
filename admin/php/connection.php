<?php
function open_connection($table = 'dbname=bbb_te') {
  $db = new PDO('mysql:host=localhost;' . $table . ';charset=utf8', 'u201501_471_g04', 'passwd');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
return $db;
}

?>