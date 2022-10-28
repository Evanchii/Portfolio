<?php
$db_url = "localhost";
$db_username = "root";
$db_password = "";
$db_table = "portfolio";

$mysqli = new mysqli($db_url, $db_username, $db_password, $db_table);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>