<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include 'db/db_anuncios.php';
require 'db/db_imagenes_anuncios.php';
require 'db/db_categorias.php';
require 'db_common.php';


$titulo = 'Home | Gasteiz Denda';
$scripts = ['assets/js/nav.js'];
$estilos = ['assets/css/default.css'];




if (isset($_GET['id'])) {
  $anuncios = getAnunciosByCategoria($_GET['id'],$conn);
}else{
  $anuncios = getAllAnuncios($conn);
}
$imagenes = getAllImagenesAnuncio($conn);
$categorias = getAllCategorias($conn);
require 'session.php';
include 'views/home.view.php';
?>
