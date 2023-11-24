<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include 'db/db_anuncios.php';
require 'db/db_imagenes_anuncios.php';
require 'db/db_categorias.php';
require 'utils/db_common.php';
require 'db/db_usuarios.php';

$titulo = 'Home | Gasteiz Denda';
$scripts = ['assets/js/nav.js', 'assets/js/home.js'];
$estilos = ['assets/css/default.css', 'assets/css/home.css'];

if (isset($_GET['id'])) {
  $anuncios = getAnunciosByCategoria($_GET['id'], $conn);
} else {
  $anuncios = getAllAnuncios($conn);
}
if (isset($_GET['search']) && isset($_GET['desde_cliente'])) {
  $anunciosBuscados = searchAnuncios($_GET['search'], $conn);
  die(json_encode($anunciosBuscados));
} elseif (isset($_GET['search'])) {
  if ($_GET['search'] !== '') {
    $anuncios = searchAnunciosImagen($_GET['search'], $conn);
  }
}
if (isset($_GET['img'])) {
  $imagen = getImagenById($_GET['img'], $conn);
  die(base64_encode($imagen['imagen']));
}

if (isset($_GET['cargar-mas'])) {
  $anunciosRecogidos = cargarMasAnuncios($_GET['cargar-mas'], $conn);
  die(json_encode($anunciosRecogidos));
}

$imagenes = getAllImagenesAnuncio($conn);
$categorias = getAllCategorias($conn);
require 'utils/session.php';
include 'views/home.view.php';
?>
