<?php
function getAllAnuncios($conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios');
  $stmt->execute();
  return $stmt->fetchAll();
}

function insertAnuncio($anuncio,$conn){
  $stmt = $conn->prepare(
    'INSERT INTO anuncios (titulo, descripcion, precio, anunciante, categoria_id) 
    VALUES (:titulo, :descripcion, :precio, :anunciante, :categoria_id)'
  );

  $stmt->execute([
    'titulo' => $anuncio['titulo'],
    'descripcion' => $anuncio['descripcion'],
    'precio' => $anuncio['precio'],
    'anunciante' => $anuncio['anunciante'],
    'categoria_id' => $anuncio['categoria'],
  ]);
}
?>
