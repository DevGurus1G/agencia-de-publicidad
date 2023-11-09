<?php
function connect($host, $dbname, $user, $password) {
  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    return $conn;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

function close($conn) {
  $conn = null;
}
