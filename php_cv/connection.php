<?php
$mysqli = new mysqli("localhost","root","","db_cv");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}



$mysqli -> close();
?>
