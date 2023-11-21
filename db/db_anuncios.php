<?php
function getAllAnuncios($conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios order by id desc');
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
  //Devuelve el ultimo id que ha siso insertado en la tabla, este sirve para saber el id del anuncio que se acaba de publicar
  return $conn->lastInsertId();
}

function getAnunciosById($anuncio,$conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios 
                          WHERE id = :id');
  $stmt->execute([
      'id'=> $anuncio
  ]);
  return $stmt->fetch();
}

function getAnunciosByCategoria($categoria,$conn){
  $stmt = $conn->prepare('SELECT * FROM anuncios
                          WHERE categoria_id = :categoria_id');
  $stmt->execute([
      'categoria_id' => $categoria
  ]);
  return $stmt->fetchAll();
}

function getAnunciosByAnunciante($anuncio,$conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios 
                          WHERE anunciante = :id');
  $stmt->execute(['id'=> $anuncio]);
  return $stmt->fetchAll();
}

function getAnunciosbyUserIdFavorito($id,$conn){
  $stmt = $conn->prepare('SELECT anuncios.*
  FROM anuncios
  INNER JOIN favoritos ON anuncios.id = favoritos.anuncio_id
  WHERE favoritos.usuario_id = :id');
  $stmt->execute(['id'=> $id]);
  return $stmt->fetchAll();
}
?>
