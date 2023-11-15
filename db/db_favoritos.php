<?php 

function getFavoritosbyUserId($favorito,$conn) {
    $stmt = $conn->prepare('SELECT * FROM favoritos 
                            WHERE usario_id = :usuario_id');
    $stmt->execute([
        'usuario_id'=> $favorito['usuario']
    ]);
    return $stmt->fetch();
  }

function insertarFavorito($usuario, $anuncio, $conn){

    $stmt = $conn->prepare(
        'INSERT INTO favoritos (usuario_id, anuncio_id) 
        VALUES (:usuario_id, :anuncio_id)'
      );
    
      $stmt->execute([
        'usuario_id' => $usuario,
        'anuncio_id' => $anuncio
      ]);

}

function borrarFavorito($usuario, $anuncio, $conn){

    $stmt = $conn->prepare(
        'DELETE FROM favoritos 
        WHERE usuario_id = :usuario_id
        AND anuncio_id = :anuncio_id'
      );
    
      $stmt->execute([
        'usuario_id' => $usuario,
        'anuncio_id' => $anuncio
      ]);

}

?>