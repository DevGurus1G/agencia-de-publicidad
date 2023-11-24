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

function deleteCategoriaById($id,$conn){
  $stmt = $conn->prepare(
    'DELETE FROM categorias 
        WHERE id = :id'
  );

  $stmt->execute([
    'id' => $id,
  ]);
}

function insertCategoria($categoria,$conn){
  $stmt = $conn->prepare(
    'INSERT INTO categorias (nombre,imagen) 
    VALUES (:nombre,:imagen)'
  );

  $stmt->execute([
    'nombre' => $categoria['nombre'],
    'imagen' => $categoria['imagen'],
  ]);

  return $conn->lastInsertId();
}

function updateCategoria($categoria, $conn) {
  $stmt = $conn->prepare(
      'UPDATE  categorias 
       SET nombre = :nombre, imagen = :imagen
       WHERE id = :id'
  );

  $stmt->execute([
      'id' => $categoria['id'],
      'imagen' => $categoria['imagen'],
      'nombre' => $categoria['nombre'], 
  ]);
}


?>