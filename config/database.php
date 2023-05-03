<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'Tamar');
define('DB_PASS', '1234');
define('DB_NAME', 'feedback');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die('Connection Failed ' . $conn->connect_error);
}
