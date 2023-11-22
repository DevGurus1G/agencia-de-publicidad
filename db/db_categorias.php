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

function updateCategoria($categoria, $conn) {
  $stmt = $conn->prepare(
    'UPDATE  categorias 
     SET nombre = :nombre
     WHERE id = :id'
  );

  $stmt->execute([
    'id' => $categoria['id'],
    'nombre' => $categoria['nombre'],
    
  ]);
}

?>