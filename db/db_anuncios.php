<?php
/**
 * Para recoger los 6 primeros anuncios
 * @param PDO $conn      La conexión a la base de datos.
 * @return array
 */
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
/**
 * Para insertar un anuncio
 * @param array $anuncios El anuncio con toda su info
 * @param PDO $conn      La conexión a la base de datos.
 * @return array
 */
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

/**
 * Para buscar por id
 * @param  $anuncio id del anuncio a buscar
 * @param PDO $conn La conexion a base de datos
 */
function getAnunciosById($anuncio, $conn) {
  $stmt = $conn->prepare('SELECT * FROM anuncios 
                          WHERE id = :id');
  $stmt->execute([
    'id' => $anuncio,
  ]);
  return $stmt->fetch();
}
/**
 * Para buscar por categoria
 * @param  $categoria id de categoria a buscar
 * @param PDO $conn La conexion a base de datos
 * @return array
 */
function getAnunciosByCategoria($categoria, $conn) {
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
  WHERE
    anuncios.categoria_id = :categoria
    AND imagenes_anuncios.id = (
      SELECT MIN(id) FROM imagenes_anuncios WHERE anuncio_id = anuncios.id
    )
  ORDER BY
    anuncio_id DESC
  ');

  $stmt->execute(['categoria' => $categoria]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * Para buscar los anuncion del anunciante
 * @param $id Id del anunciante
 * @param PDO $conn La conexion a base de datos
 * @return array
 */
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

/**
 * Paara buscar los anuncios favoritos de un usuario
 * @param $id Id del usuario
 * @param PDO $conn La conexion a base de datos
 * @return array
 */
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

/**
 * Para borrar un anuncio
 * @param $id ID del anuncio
 * @param PDO $conn La conexion a base de datos
 *
 */

function deleteAnuncioById($id, $conn) {
  $stmt = $conn->prepare(
    'DELETE FROM anuncios 
        WHERE id = :id'
  );

  $stmt->execute([
    'id' => $id,
  ]);
}

/**
 * Para buscar anuncios por titulo o descripcion
 * @param $buscar Lo que se tiene que buscar
 * @param PDO $conn La conexion a base de datos
 * @return array
 */
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

/**
 * Para buscar los anuncios por anunciante completos
 * @param $id Id del anunciante
 * @param PDO $conn
 * @return array
 */
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

/**
 * Para buscar todas las imagenes de los anuncios
 * @param $buscar Lo que hay que buscar
 * @param PDO $conn La conexion a base de datos
 * @return array
 */
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
/**
 * Para cargar los anuncios siguientes de la fecha
 * @param $fecha La ultima fecha del anuncio mostrado
 * @param PDO $conn La conexion a base de datos
 * @return array
 */
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

/**
 * Para actualizar un anuncios
 * @param array $anuncio El anuncio con su nueva info
 * @param PDO $conn La conexion a base de datos
 */
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
}
/**
 * Para recoger los todos los anuncios para admin
 * @param PDO $conn      La conexión a la base de datos.
 * @return array
 */
function getAllAnunciosTexto($conn) {
  $stmt = $conn->prepare('SELECT
  anuncios.id AS anuncio_id,
  anuncios.titulo,
  anuncios.descripcion,
  anuncios.precio,
  anuncios.anunciante,
  anuncios.categoria_id,
  anuncios.creado,
  categorias.nombre AS nombre_categoria,
  usuarios.username AS nombre_anunciante
FROM
  anuncios
JOIN
  categorias ON anuncios.categoria_id = categorias.id
JOIN
  usuarios ON anuncios.anunciante = usuarios.id
ORDER BY
  anuncio_id DESC
');

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
