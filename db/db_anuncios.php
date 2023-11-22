<?php
function getAllAnuncios($conn) {
  $stmt = $conn->prepare('SELECT
    anuncios.id AS anuncio_id,
    anuncios.titulo,
    anuncios.descripcion,
    anuncios.precio,
    anuncios.anunciante,
    anuncios.categoria_id,
    categorias.nombre AS nombre_categoria,
    usuarios.username AS nombre_anunciante,
    imagenes_anuncios.id AS primera_imagen_id,
    imagenes_anuncios.imagen AS primera_imagen
FROM
    anuncios
JOIN
    categorias ON anuncios.categoria_id = categorias.id
JOIN
    usuarios ON anuncios.anunciante = usuarios.id
LEFT JOIN (
    SELECT
        anuncio_id,
        MIN(id) AS id,
        imagen
    FROM
        imagenes_anuncios
    GROUP BY
        anuncio_id, imagen
) AS imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
ORDER BY
    anuncios.id DESC;
');

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertAnuncio($anuncio, $conn) {
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

function getAnunciosById($anuncio, $conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios 
                          WHERE id = :id');
  $stmt->execute([
    'id' => $anuncio,
  ]);
  return $stmt->fetch();
}

function getAnunciosByCategoria($categoria, $conn) {
  $stmt = $conn->prepare('SELECT
    anuncios.id AS anuncio_id,
    anuncios.titulo,
    anuncios.descripcion,
    anuncios.precio,
    anuncios.anunciante,
    anuncios.categoria_id,
    categorias.nombre AS nombre_categoria,
    usuarios.username AS nombre_anunciante,
    imagenes_anuncios.id AS primera_imagen_id,
    imagenes_anuncios.imagen AS primera_imagen
FROM
    anuncios
JOIN
    categorias ON anuncios.categoria_id = categorias.id
JOIN
    usuarios ON anuncios.anunciante = usuarios.id
LEFT JOIN (
    SELECT
        anuncio_id,
        MIN(id) AS id,
        imagen
    FROM
        imagenes_anuncios
    GROUP BY
        anuncio_id, imagen
) AS imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
where anuncios.categoria_id = :categoria
ORDER BY
    anuncios.id DESC;
');

  $stmt->execute(['categoria' => $categoria]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAnunciosByAnunciante($anuncio, $conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios 
                          WHERE anunciante = :id');
  $stmt->execute(['id' => $anuncio]);
  return $stmt->fetchAll();
}

function getAnunciosbyUserIdFavorito($id, $conn) {
  $stmt = $conn->prepare('SELECT anuncios.*
  FROM anuncios
  INNER JOIN favoritos ON anuncios.id = favoritos.anuncio_id
  WHERE favoritos.usuario_id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetchAll();
}

function deleteAnuncioById($id,$conn){
  $stmt = $conn->prepare(
    'DELETE FROM anuncios 
        WHERE id = :id'
  );

  $stmt->execute([
    'id' => $id,
  ]);
}

?>
