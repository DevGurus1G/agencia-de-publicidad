<?php
require 'db/db_favoritos.php';
require 'db/db_anuncios.php';
require 'db/db_imagenes_anuncios.php';
//Para que el filtro de categorias del header funcione
require 'utils/db_common.php';
require 'db/db_categorias.php';
require 'vendor/autoload.php';
$categorias = getAllCategorias($conn);

//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';

if(!isset($_SESSION['usuario'])){
  header("Location: /");
}

$tipoUsuario = $_SESSION['usuario']['tipo'];

if ($tipoUsuario == 'tienda') {
  $anuncios = getAnunciosByAnunciante($_SESSION['usuario']['id'], $conn);
} else {
  $anuncios = getAnunciosbyUserIdFavorito($_SESSION['usuario']['id'], $conn);
}
$imagenes = getAllImagenesAnuncio($conn);

$estilos = ['../assets/css/default.css', '../assets/css/user_anuncio.css'];
$titulo = 'Gestionar anuncios | Gasteiz Denda';
$scripts = ['../assets/js/nav.js'];

if (isset($_GET['borrar'])) {
  borrarAnuncio();
}

require 'views/user_anuncio.view.php';

function borrarAnuncio(){
  $id = $_GET['id'];
  $conn = connect(
    $_ENV['HOST'],
    $_ENV['DB_NOMBRE'],
    $_ENV['USER'],
    $_ENV['USER_PASSWORD']
  );
  deleteAnuncioById($id,$conn);
  header('Location: /user/anuncio');

}



?>
