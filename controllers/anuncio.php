<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require 'db/db_anuncios.php';
require 'db/db_favoritos.php';
require 'db/db_imagenes_anuncios.php';
require 'db/db_usuarios.php';
require 'utils/db_common.php';

//Para que el filtro de categorias del header funcione
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

global $anuncio;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario'])) {
  if ($_POST['favorito'] == 'insertar') {
    insertarFavorito($_SESSION['usuario']['id'], $_POST['anuncio'], $conn);
  } elseif ($_POST['favorito'] == 'borrar') {
    borrarFavorito($_SESSION['usuario']['id'], $_POST['anuncio'], $conn);
  }
} else if (isset($_GET['id'])) {
    $anuncio = getAnunciosById($_GET['id'], $conn);
    $imagenes = getAllImagenesAnuncioByIdAnuncio($_GET['id'], $conn);
    $anunciante = getUsernameById($anuncio['anunciante'], $conn);
    $categoria_anuncio = getCategoriaNameById($anuncio['categoria_id'], $conn);
    if (isset($_SESSION['usuario'])) {
      $favorito = getFavoritoByUserAndAnuncio(
        $_SESSION['usuario']['id'],
        $_GET['id'],
        $conn
      );
    }
    $titulo = isset($anuncio['titulo'])
    ? $anuncio['titulo']
    : '' . ' | Gateiz Denda';
  $estilos = ['assets/css/default.css', 'assets/css/anuncio.css'];
  $scripts = ['assets/js/nav.js', 'assets/js/anuncio.js'];
  require 'utils/session.php';
  require 'views/anuncio.view.php';
  }else{
    header("Location: /");
    exit();
  }

?>
