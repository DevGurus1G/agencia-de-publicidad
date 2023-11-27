<?php
require 'db/db_anuncios.php';
require 'db/db_categorias.php';
require 'db/db_imagenes_anuncios.php';
require 'utils/db_common.php';
// Para todo lo relacionado a la sesión del usuario
require 'utils/session.php';

/**
 * Redirecciona a la página principal si el usuario no es de tipo tienda.
 */
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'tienda') {
  header('Location: /');
  exit();
}

/**
 * Obtiene todas las categorías disponibles.
 *
 * @var array $categorias
 */
$categorias = getAllCategorias($conn);

/**
 * Estilos CSS utilizados en la página.
 *
 * @var array $estilos
 */
$estilos = ['../assets/css/default.css', '../assets/css/manage_anuncio.css'];

/**
 * Registra un nuevo anuncio.
 *
 * @param PDO $conn La conexión a la base de datos.
 */
function registrar($conn) {
  $usuarioId = $_SESSION['usuario']['id'];
  $anuncio = [
    'titulo' => $_POST['titulo'],
    'descripcion' => $_POST['descripcion'],
    'precio' => $_POST['precio'],
    'anunciante' => $usuarioId,
    'categoria' => $_POST['categoria'],
  ];
  $anuncioId = insertAnuncio($anuncio, $conn);
  agregarFotos($anuncioId, $conn);
  die('registrado');
}

/**
 * Edita un anuncio existente.
 *
 * @param PDO $conn La conexión a la base de datos.
 */
function editarAnuncio($conn) {
  $anuncio = getAnunciosById($_GET['editar'], $conn);
  $anuncio_actualizado = [
    'id' => $anuncio['id'],
    'titulo' => $_POST['titulo'],
    'descripcion' => $_POST['descripcion'],
    'precio' => $_POST['precio'],
    'categoria' => $_POST['categoria'],
  ];

  // Llama a la función updateAnuncio
  updateAnuncio($anuncio_actualizado, $conn);
  $imagenes = getAllImagenesAnuncioByIdAnuncio($_GET['editar'], $conn);
  $imagen1 = file_get_contents($_FILES['imagen1']['tmp_name']);
  $imagen2 = file_get_contents($_FILES['imagen2']['tmp_name']);
  $imagen3 = file_get_contents($_FILES['imagen3']['tmp_name']);
  $imagenes_nuevas = [$imagen1, $imagen2, $imagen3];
  $cont = 0;
  foreach ($imagenes as $imagen) {
    updateImagenAnuncio($imagen['id'], $imagenes_nuevas[$cont], $conn);
    $cont++;
  }
  die('actualizado');
}

/**
 * Agrega fotos a un anuncio.
 *
 * @param int      $anuncioId El ID del anuncio.
 * @param PDO $conn      La conexión a la base de datos.
 */
function agregarFotos($anuncioId, $conn) {
  $imagen1 = file_get_contents($_FILES['imagen1']['tmp_name']);
  $imagen2 = file_get_contents($_FILES['imagen2']['tmp_name']);
  $imagen3 = file_get_contents($_FILES['imagen3']['tmp_name']);
  insertImagenAnuncio($imagen1, $anuncioId, $conn);
  insertImagenAnuncio($imagen2, $anuncioId, $conn);
  insertImagenAnuncio($imagen3, $anuncioId, $conn);
}

/**
 * Obtiene información del anuncio si se está editando.
 */
if (isset($_GET['editar'])) {
  $anuncio = getAnunciosById($_GET['editar'], $conn);
  $imagenes = getAllImagenesAnuncioByIdAnuncio($_GET['editar'], $conn);
}

/**
 * Elimina un anuncio según el ID proporcionado en la URL.
 */
if (isset($_GET['borrar'])) {
  deleteAnuncioById($_GET['borrar'], $conn);
  header('Location: /');
}

/**
 * Procesa la solicitud POST para registrar o editar un anuncio.
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['editar_anuncio'] != -1) {
    editarAnuncio($conn);
  } else {
    registrar($conn);
  }
} else {
  $titulo = 'Registro anuncio | Gasteiz Denda';
  $scripts = ['../assets/js/nav.js', '../assets/js/manage_anuncio.js'];
  $estilos = ['../assets/css/default.css', '../assets/css/manage_anuncio.css'];
  $categorias = getAllCategorias($conn);

  require 'views/manage_anuncio.view.php';
}
?>
