<?php
// Incluir archivos relacionados con la base de datos y funciones comunes
require 'db/db_anuncios.php';
require 'db/db_favoritos.php';
require 'db/db_imagenes_anuncios.php';
require 'db/db_usuarios.php';
require 'utils/db_common.php';

// Incluir el archivo para la gestión de sesiones de usuario
require 'utils/session.php';

// Obtener todas las categorías para el filtro del encabezado
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

/**
 * Variable global para almacenar información del anuncio.
 *
 * @global array $anuncio
 */
global $anuncio;

/**
 * Maneja las operaciones de favoritos cuando se recibe una solicitud POST.
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario'])) {
  // Verificar si se debe insertar o borrar el anuncio de la lista de favoritos
  if ($_POST['favorito'] == 'insertar') {
    insertarFavorito($_SESSION['usuario']['id'], $_POST['anuncio'], $conn);
  } elseif ($_POST['favorito'] == 'borrar') {
    borrarFavorito($_SESSION['usuario']['id'], $_POST['anuncio'], $conn);
  }
} elseif (isset($_GET['id'])) {
  // Obtener información del anuncio y sus imágenes si se proporciona un ID
  $anuncio = getAnunciosById($_GET['id'], $conn);
  $imagenes = getAllImagenesAnuncioByIdAnuncio($_GET['id'], $conn);
  $anunciante = getUsernameById($anuncio['anunciante'], $conn);
  $categoria_anuncio = getCategoriaNameById($anuncio['categoria_id'], $conn);

  // Verificar si hay un usuario logueado para gestionar la opción de favoritos
  if (isset($_SESSION['usuario'])) {
    $favorito = getFavoritoByUserAndAnuncio(
      $_SESSION['usuario']['id'],
      $_GET['id'],
      $conn
    );
  }

  /**
   * Título de la página del anuncio.
   *
   * @var string $titulo
   */
  $titulo = isset($anuncio['titulo'])
    ? $anuncio['titulo']
    : '' . ' | Gateiz Denda';

  /**
   * Estilos para la página del anuncio.
   *
   * @var array $estilos
   */
  $estilos = ['assets/css/default.css', 'assets/css/anuncio.css'];

  /**
   * Archivos de script para la página del anuncio.
   *
   * @var array $scripts
   */
  $scripts = ['assets/js/nav.js', 'assets/js/anuncio.js'];

  // Incluir la vista correspondiente para la página del anuncio
  require 'views/anuncio.view.php';
} else {
  // Redirigir a la página principal si no se proporciona un ID válido
  header('Location: /');
  exit();
}
?>
