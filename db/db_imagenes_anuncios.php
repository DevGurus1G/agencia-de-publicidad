<?php
function insertImagenAnuncio($imagen,$anuncioId, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO imagenes_anuncios (imagen, anuncio_id) 
    VALUES (:imagen,:anuncio)'
  );
  $stmt->execute([
    'imagen' => $imagen,
    'anuncio' => $anuncioId,
  ]);
}
?>
