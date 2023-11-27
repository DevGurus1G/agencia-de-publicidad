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

// Redireccionar a la página principal si no hay un usuario logueado
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

// Verificar si se está intentando borrar un anuncio de la lista de favoritos
if (isset($_GET['id'])) {
  // Obtener información del usuario y del anuncio a borrar de favoritos
  $usuario = $_SESSION['usuario']['id'];
  $anuncio = $_GET['id'];

  // Llamar a la función para borrar el anuncio de la lista de favoritos
  borrarFavorito($usuario, $anuncio, $conn);

  // Redirigir a la página de anuncios del usuario
  header('Location: /user/anuncio');
  exit();
}

// Obtener el tipo de usuario
$tipoUsuario = $_SESSION['usuario']['tipo'];

// Obtener anuncios según el tipo de usuario
if ($tipoUsuario == 'tienda') {
  // Obtener anuncios creados por la tienda
  $anuncios = getAnunciosByAnunciante($_SESSION['usuario']['id'], $conn);
} else {
  // Obtener anuncios marcados como favoritos por el usuario normal
  $anuncios = getAnunciosbyUserIdFavorito($_SESSION['usuario']['id'], $conn);
}

/**
 * Estilos para la página de gestión de anuncios del usuario.
 *
 * @var array $estilos
 */
$estilos = ['../assets/css/default.css', '../assets/css/user_anuncio.css'];

/**
 * Título de la página de gestión de anuncios del usuario.
 *
 * @var string $titulo
 */
$titulo = 'Gestionar anuncios | Gasteiz Denda';

/**
 * Archivos de script para la página de gestión de anuncios del usuario.
 *
 * @var array $scripts
 */
$scripts = ['../assets/js/nav.js'];

// Incluir la vista correspondiente para la página de gestión de anuncios del usuario
require 'views/user_anuncio.view.php';
?>
