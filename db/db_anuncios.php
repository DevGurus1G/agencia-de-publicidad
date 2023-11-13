<?php
function getAllAnuncios($conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios');
  $stmt->execute();
  return $stmt->fetchAll();
}
?>
