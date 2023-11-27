<?php
/**
 * Obtiene los favoritos asociados a un usuario.
 *
 * @param array    $favorito Un arreglo que contiene la información del usuario y anuncio.
 * @param PDO      $conn     El objeto PDO que representa la conexión a la base de datos.
 * @return mixed Un solo registro de la tabla de favoritos o false si no se encuentra ninguno.
 */
function getFavoritosbyUserId($favorito, $conn) {
  $stmt = $conn->prepare('SELECT * FROM favoritos 
                            WHERE usuario_id = :usuario_id');
  $stmt->execute([
    'usuario_id' => $favorito['usuario'],
  ]);
  return $stmt->fetch();
}

/**
 * Inserta un nuevo favorito en la base de datos.
 *
 * @param int $usuario El ID del usuario.
 * @param int $anuncio El ID del anuncio.
 * @param PDO $conn    El objeto PDO que representa la conexión a la base de datos.
 */
function insertarFavorito($usuario, $anuncio, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO favoritos (usuario_id, anuncio_id) 
        VALUES (:usuario_id, :anuncio_id)'
  );

  $stmt->execute([
    'usuario_id' => $usuario,
    'anuncio_id' => $anuncio,
  ]);
}

/**
 * Elimina un favorito de la base de datos.
 *
 * @param int $usuario El ID del usuario.
 * @param int $anuncio El ID del anuncio.
 * @param PDO $conn    El objeto PDO que representa la conexión a la base de datos.
 */
function borrarFavorito($usuario, $anuncio, $conn) {
  $stmt = $conn->prepare(
    'DELETE FROM favoritos 
        WHERE usuario_id = :usuario_id
        AND anuncio_id = :anuncio_id'
  );

  $stmt->execute([
    'usuario_id' => $usuario,
    'anuncio_id' => $anuncio,
  ]);
}

/**
 * Obtiene un favorito específico asociado a un usuario y anuncio.
 *
 * @param int $usuario El ID del usuario.
 * @param int $anuncio El ID del anuncio.
 * @param PDO $conn    El objeto PDO que representa la conexión a la base de datos.
 * @return mixed Un solo registro de la tabla de favoritos o false si no se encuentra ninguno.
 */
function getFavoritoByUserAndAnuncio($usuario, $anuncio, $conn) {
  $stmt = $conn->prepare(
    "SELECT * FROM favoritos 
     WHERE usuario_id = :usuario 
     AND anuncio_id = :anuncio"
  );
  $stmt->execute([':usuario' => $usuario, ':anuncio' => $anuncio]);
  return $stmt->fetch();
}
?>
