<?php
/**
 * Obtiene todas las categorías.
 *
 * @param PDO $conn La conexión a la base de datos.
 * @return array
 */
function getAllCategorias($conn) {
  $stmt = $conn->prepare('SELECT * FROM categorias');
  $stmt->execute();
  return $stmt->fetchAll();
}

/**
 * Obtiene el nombre de una categoría por su ID.
 *
 * @param int      $id   El ID de la categoría.
 * @param PDO $conn La conexión a la base de datos.
 * @return array
 */
function getCategoriaNameById($id, $conn) {
  $stmt = $conn->prepare('SELECT * FROM categorias where id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}

/**
 * Elimina una categoría por su ID.
 *
 * @param int      $id   El ID de la categoría a eliminar.
 * @param PDO $conn La conexión a la base de datos.
 */
function deleteCategoriaById($id, $conn) {
  $stmt = $conn->prepare(
    'DELETE FROM categorias 
        WHERE id = :id'
  );

  $stmt->execute([
    'id' => $id,
  ]);
}

/**
 * Inserta una nueva categoría.
 *
 * @param array    $categoria Un array asociativo con los datos de la categoría.
 * @param PDO $conn      La conexión a la base de datos.
 * @return int El ID de la nueva categoría insertada.
 */
function insertCategoria($categoria, $conn) {
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

/**
 * Actualiza la información de una categoría.
 *
 * @param array    $categoria Un array asociativo con los datos actualizados de la categoría.
 * @param PDO $conn      La conexión a la base de datos.
 */
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
