<?php
require 'db/db_favoritos.php';
require 'db/db_anuncios.php';
require 'db/db_imagenes_anuncios.php';
//Para que el filtro de categorias del header funcione
require 'utils/db_common.php';
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';

if (!isset($_SESSION['usuario'])) {
  header('Location: /');
}

if (isset($_GET['id'])) {

  $usuario = $_SESSION['usuario']['id'];
  $anuncio = $_GET['id'];
 
  borrarFavorito($usuario, $anuncio, $conn);

  header('Location: /user/anuncio');

}

$tipoUsuario = $_SESSION['usuario']['tipo'];

if ($tipoUsuario == 'tienda') {
  $anuncios = getAnunciosByAnunciante($_SESSION['usuario']['id'], $conn);
} else {
  $anuncios = getAnunciosbyUserIdFavorito($_SESSION['usuario']['id'], $conn);
}

$estilos = ['../assets/css/default.css', '../assets/css/user_anuncio.css'];
$titulo = 'Gestionar anuncios | Gasteiz Denda';
$scripts = ['../assets/js/nav.js'];
require 'views/user_anuncio.view.php';

?>
