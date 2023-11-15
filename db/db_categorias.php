<?php
function getAllCategorias($conn) {
  $stmt = $conn->prepare('SELECT * FROM categorias');
  $stmt->execute();
  return $stmt->fetchAll();
}