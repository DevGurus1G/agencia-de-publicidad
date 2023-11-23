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
$scripts = ['assets/js/nav.js'];
$estilos = ['assets/css/default.css'];

if (isset($_GET['id'])) {
  $anuncios = getAnunciosByCategoria($_GET['id'], $conn);
} else {
  $anuncios = getAllAnuncios($conn);
}
if (isset($_GET['search'])) {
  $anunciosBuscados = searchAnuncios($_GET['search'], $conn);
  die(json_encode($anunciosBuscados));
}
if (isset($_GET['img'])) {
  $imagen = getImagenById($_GET['img'], $conn);
  // header('Content-Type: image/png');
  // print_r($imagen);
  die(base64_encode($imagen['imagen']));
}

$imagenes = getAllImagenesAnuncio($conn);
$categorias = getAllCategorias($conn);
require 'utils/session.php';
include 'views/home.view.php';
?>
