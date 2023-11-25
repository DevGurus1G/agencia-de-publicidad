<?php
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

function getAllImagenesAnuncioByIdAnuncio($id, $conn) {
  $stmt = $conn->prepare(
    'select * from imagenes_anuncios where anuncio_id = :id'
  );
  $stmt->execute([
    'id' => $id,
  ]);
  return $stmt->fetchAll();
}

function getAllImagenesAnuncio($conn) {
  $stmt = $conn->prepare('select * from imagenes_anuncios');
  $stmt->execute();
  return $stmt->fetchAll();
}

function getImagenById($id, $conn) {
  $stmt = $conn->prepare('SELECT imagen from imagenes_anuncios where id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}
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
