<?php
function getAllAnuncios($conn) {
  $stmt = $conn->prepare('SELECT
    anuncios.id AS anuncio_id,
    anuncios.titulo,
    anuncios.descripcion,
    anuncios.precio,
    anuncios.anunciante,
    anuncios.categoria_id,
    anuncios.creado,
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
  LEFT JOIN imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
  WHERE imagenes_anuncios.id = (
    SELECT MIN(id) FROM imagenes_anuncios WHERE anuncio_id = anuncios.id
  )
  ORDER BY
    anuncio_id DESC
  LIMIT 6');

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

function getAnunciosByAnunciante($id, $conn) {
  $stmt = $conn->prepare('SELECT
    anuncios.id AS anuncio_id,
    anuncios.titulo,
    anuncios.descripcion,
    anuncios.precio,
    anuncios.anunciante,
    anuncios.categoria_id,
    anuncios.creado,
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
  LEFT JOIN imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
  WHERE imagenes_anuncios.id = (
    SELECT MIN(id) FROM imagenes_anuncios WHERE anuncio_id = anuncios.id
  ) AND anuncios.anunciante = :id
  ORDER BY
    anuncio_id DESC
  LIMIT 6');

  $stmt->execute(['id' => $id]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAnunciosbyUserIdFavorito($id, $conn) {
  $stmt = $conn->prepare('SELECT
      anuncios.id AS anuncio_id,
      anuncios.titulo,
      anuncios.descripcion,
      anuncios.precio,
      anuncios.anunciante,
      anuncios.categoria_id,
      anuncios.creado,
      categorias.nombre AS nombre_categoria,
      usuarios.username AS nombre_anunciante,
      MIN(imagenes_anuncios.id) AS primera_imagen_id,
      MIN(imagenes_anuncios.imagen) AS primera_imagen
    FROM
      anuncios
    JOIN
      categorias ON anuncios.categoria_id = categorias.id
    JOIN
      usuarios ON anuncios.anunciante = usuarios.id
    LEFT JOIN imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
    INNER JOIN favoritos ON anuncios.id = favoritos.anuncio_id
    WHERE
      favoritos.usuario_id = :id
    GROUP BY
      anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.precio, anuncios.anunciante, anuncios.categoria_id, categorias.nombre, usuarios.username
    ORDER BY
      anuncios.id DESC');

  $stmt->execute(['id' => $id]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteAnuncioById($id, $conn) {
  $stmt = $conn->prepare(
    'DELETE FROM anuncios 
        WHERE id = :id'
  );

  $stmt->execute([
    'id' => $id,
  ]);
}

function searchAnuncios($buscar, $conn) {
  $stmt = $conn->prepare('SELECT
      anuncios.id AS anuncio_id,
      anuncios.titulo,
      anuncios.descripcion,
      anuncios.precio,
      anuncios.anunciante,
      anuncios.categoria_id,
      categorias.nombre AS nombre_categoria,
      usuarios.username AS nombre_anunciante,
      imagenes_anuncios.id AS primera_imagen_id
    FROM
      anuncios
    JOIN
      categorias ON anuncios.categoria_id = categorias.id
    JOIN
      usuarios ON anuncios.anunciante = usuarios.id
    LEFT JOIN (
      SELECT
        anuncio_id,
        MIN(id) AS id
      FROM
        imagenes_anuncios
      GROUP BY
        anuncio_id
    ) AS imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
    WHERE
      LOWER(anuncios.titulo) LIKE LOWER(:buscar)
      OR LOWER(anuncios.descripcion) LIKE LOWER(:buscar)
    ORDER BY
      anuncios.id DESC
  ');

  $stmt->execute(['buscar' => "%$buscar%"]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAnunciosByIdAnuncianteCompletos($id, $conn) {
  $stmt = $conn->prepare('SELECT
  anuncios.id AS anuncio_id,
  anuncios.titulo,
  anuncios.descripcion,
  anuncios.precio,
  anuncios.anunciante,
  anuncios.categoria_id,
  anuncios.creado,
  categorias.nombre AS nombre_categoria,
  usuarios.username AS nombre_anunciante,
  MIN(imagenes_anuncios.id) AS primera_imagen_id,
  MIN(imagenes_anuncios.imagen) AS primera_imagen
FROM
  anuncios
JOIN
  categorias ON anuncios.categoria_id = categorias.id
JOIN
  usuarios ON anuncios.anunciante = usuarios.id
LEFT JOIN imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
WHERE
  anuncios.anunciante = :idAnunciante
GROUP BY
  anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.precio, anuncios.anunciante, anuncios.categoria_id, categorias.nombre, usuarios.username
ORDER BY
  anuncios.id DESC;
');

  $stmt->execute(['idAnunciante' => $id]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchAnunciosImagen($buscar, $conn) {
  $stmt = $conn->prepare('SELECT
  anuncios.id AS anuncio_id,
  anuncios.titulo,
  anuncios.descripcion,
  anuncios.precio,
  anuncios.anunciante,
  anuncios.categoria_id,
  anuncios.creado,
  categorias.nombre AS nombre_categoria,
  usuarios.username AS nombre_anunciante,
  MIN(imagenes_anuncios.id) AS primera_imagen_id, -- Se agrega la función de agregación MIN para la columna id
  MIN(imagenes_anuncios.imagen) AS primera_imagen -- Se agrega la función de agregación MIN para la columna imagen
FROM
  anuncios
JOIN
  categorias ON anuncios.categoria_id = categorias.id
JOIN
  usuarios ON anuncios.anunciante = usuarios.id
LEFT JOIN
  imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
WHERE
  LOWER(anuncios.titulo) LIKE LOWER(:buscar)
  OR LOWER(anuncios.descripcion) LIKE LOWER(:buscar)
GROUP BY
  anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.precio, anuncios.anunciante, anuncios.categoria_id, anuncios.creado, categorias.nombre, usuarios.username
ORDER BY
  anuncios.id DESC;
');

  $stmt->execute(['buscar' => "%$buscar%"]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cargarMasAnuncios($fecha, $conn) {
  $stmt = $conn->prepare('SELECT
  anuncios.id AS anuncio_id,
  anuncios.titulo,
  anuncios.descripcion,
  anuncios.precio,
  anuncios.anunciante,
  anuncios.categoria_id,
  anuncios.creado,
  categorias.nombre AS nombre_categoria,
  usuarios.username AS nombre_anunciante,
  MIN(imagenes_anuncios.id) AS primera_imagen_id
FROM
  anuncios
JOIN
  categorias ON anuncios.categoria_id = categorias.id
JOIN
  usuarios ON anuncios.anunciante = usuarios.id
LEFT JOIN imagenes_anuncios ON anuncios.id = imagenes_anuncios.anuncio_id
WHERE anuncios.creado < :fecha
GROUP BY
  anuncios.id, anuncios.titulo, anuncios.descripcion, anuncios.precio, anuncios.anunciante, anuncios.categoria_id, categorias.nombre, usuarios.username
ORDER BY
  anuncios.id DESC
LIMIT 6;
');

  $stmt->execute(['fecha' => $fecha]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateAnuncio($anuncio, $conn) {
  $stmt = $conn->prepare(
    'UPDATE anuncios SET titulo = :titulo, descripcion = :descripcion, precio = :precio, categoria_id = :categoria WHERE id = :id'
  );
  $stmt->execute([
    ':titulo' => $anuncio['titulo'],
    ':descripcion' => $anuncio['descripcion'],
    ':precio' => $anuncio['precio'],
    ':categoria' => $anuncio['categoria'],
    ':id' => $anuncio['id'],
  ]);

  // if ($stmt->rowCount() > 0) {
  //   return true;
  // } else {
  //   return false;
  // }
}
?>
