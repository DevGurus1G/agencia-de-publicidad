<?php
/**
 * Inserta una nueva imagen asociada a un anuncio en la base de datos.
 *
 * @param string $imagen   Los datos binarios de la imagen.
 * @param int    $anuncioId El ID del anuncio al que se asociará la imagen.
 * @param PDO    $conn      El objeto PDO que representa la conexión a la base de datos.
 */
function insertImagenAnuncio($imagen, $anuncioId, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO imagenes_anuncios (imagen, anuncio_id) 
    VALUES (:imagen,:anuncio)'
  );
  $stmt->execute([
    'imagen' => $imagen,
    'anuncio' => $anuncioId,
  ]);
}

/**
 * Obtiene todas las imágenes asociadas a un anuncio específico.
 *
 * @param int $id   El ID del anuncio.
 * @param PDO $conn El objeto PDO que representa la conexión a la base de datos.
 * @return array Un arreglo de todas las imágenes asociadas al anuncio.
 */
function getAllImagenesAnuncioByIdAnuncio($id, $conn) {
  $stmt = $conn->prepare(
    'SELECT * FROM imagenes_anuncios WHERE anuncio_id = :id'
  );
  $stmt->execute([
    'id' => $id,
  ]);
  return $stmt->fetchAll();
}

/**
 * Obtiene todas las imágenes de todos los anuncios.
 *
 * @param PDO $conn El objeto PDO que representa la conexión a la base de datos.
 * @return array Un arreglo de todas las imágenes asociadas a todos los anuncios.
 */
function getAllImagenesAnuncio($conn) {
  $stmt = $conn->prepare('SELECT * FROM imagenes_anuncios');
  $stmt->execute();
  return $stmt->fetchAll();
}

/**
 * Obtiene la información de una imagen específica por su ID.
 *
 * @param int $id   El ID de la imagen.
 * @param PDO $conn El objeto PDO que representa la conexión a la base de datos.
 * @return mixed Un solo registro de la tabla de imágenes o false si no se encuentra la imagen.
 */
function getImagenById($id, $conn) {
  $stmt = $conn->prepare('SELECT imagen FROM imagenes_anuncios WHERE id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}

/**
 * Actualiza la información de una imagen de anuncio en la base de datos.
 *
 * @param int    $imagenId El ID de la imagen a actualizar.
 * @param string $imagen   Los nuevos datos binarios de la imagen.
 * @param PDO    $conn     El objeto PDO que representa la conexión a la base de datos.
 */
function updateImagenAnuncio($imagenId, $imagen, $conn) {
  $stmt = $conn->prepare(
    'UPDATE imagenes_anuncios SET imagen = :imagen WHERE id = :id'
  );
  $stmt->execute([
    'imagen' => $imagen,
    'id' => $imagenId,
  ]);
}
?>
