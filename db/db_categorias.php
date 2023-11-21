<?php
function getAllCategorias($conn) {
  $stmt = $conn->prepare('SELECT * FROM categorias');
  $stmt->execute();
  return $stmt->fetchAll();
}

function getCategoriaNameById($id, $conn) {
  $stmt = $conn->prepare('SELECT * FROM categorias where id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}
