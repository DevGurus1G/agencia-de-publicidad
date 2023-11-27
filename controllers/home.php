<?php
include 'db/db_anuncios.php';
require 'db/db_imagenes_anuncios.php';
require 'db/db_categorias.php';
require 'utils/db_common.php';
require 'db/db_usuarios.php';
// Para todo lo relacionado a la sesión del usuario
require 'utils/session.php';

/**
 * Título de la página.
 *
 * @var string $titulo
 */
$titulo = 'Home | Gasteiz Denda';

/**
 * Scripts JavaScript utilizados en la página.
 *
 * @var array $scripts
 */
$scripts = ['assets/js/nav.js', 'assets/js/home.js'];

/**
 * Estilos CSS utilizados en la página.
 *
 * @var array $estilos
 */
$estilos = ['assets/css/default.css', 'assets/css/home.css'];

/**
 * Obtiene anuncios según la categoría especificada en la URL.
 *
 * @var array $anuncios
 */
if (isset($_GET['id'])) {
  $anuncios = getAnunciosByCategoria($_GET['id'], $conn);
} else {
  $anuncios = getAllAnuncios($conn);
}

/**
 * Realiza una búsqueda de anuncios según el término especificado en la URL.
 *
 * @var array $anunciosBuscados
 */
if (isset($_GET['search']) && isset($_GET['desde_cliente'])) {
  $anunciosBuscados = searchAnuncios($_GET['search'], $conn);
  die(json_encode($anunciosBuscados));
} elseif (isset($_GET['search'])) {
  if ($_GET['search'] !== '') {
    $anuncios = searchAnunciosImagen($_GET['search'], $conn);
  }
}

/**
 * Obtiene la imagen de un anuncio según el ID especificado en la URL.
 *
 * @var string $imagen
 */
if (isset($_GET['img'])) {
  $imagen = getImagenById($_GET['img'], $conn);
  die(base64_encode($imagen['imagen']));
}

/**
 * Realiza la carga de más anuncios según el parámetro especificado en la URL.
 *
 * @var array $anunciosRecogidos
 */
if (isset($_GET['cargar-mas'])) {
  $anunciosRecogidos = cargarMasAnuncios($_GET['cargar-mas'], $conn);
  die(json_encode($anunciosRecogidos));
}

/**
 * Obtiene todas las imágenes de anuncios.
 *
 * @var array $imagenes
 */
$imagenes = getAllImagenesAnuncio($conn);

/**
 * Obtiene todas las categorías disponibles.
 *
 * @var array $categorias
 */
$categorias = getAllCategorias($conn);

include 'views/home.view.php';
?>
