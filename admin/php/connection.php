<?php
function open_connection() {
  $db = new PDO('mysql:host=localhost;dbname=bbb_te;charset=utf8', 'u201501_471_g04', 'passwd');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
return $db;
}

?>