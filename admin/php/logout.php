<?php
session_start();
session_unset();

include_once 'constants.php';

header('Location: ' . $GLOBALS['locations']['home']);
die();
?>