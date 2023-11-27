<?php
// Incluir archivos relacionados con la base de datos y funciones comunes
include 'db/db_usuarios.php';
include 'db/db_anuncios.php';
include 'db/db_imagenes_anuncios.php';
include 'db/db_categorias.php';
require 'utils/db_common.php';

// Incluir el archivo para la gestión de sesiones de usuario
require 'utils/session.php';

/**
 * Redirige a la página principal si no se proporciona un ID de anunciante válido.
 */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location: /');
  exit();
}

/**
 * Nombre de usuario del anunciante.
 *
 * @var string $anunciante
 */
$anunciante = getUsernameById($_GET['id'], $conn);

/**
 * Lista de anuncios completos del anunciante.
 *
 * @var array $anuncios
 */
$anuncios = getAnunciosByIdAnuncianteCompletos($_GET['id'], $conn);

/**
 * Todas las categorías para el filtro del encabezado.
 *
 * @var array $categorias
 */
$categorias = getAllCategorias($conn);

/**
 * Estilos para la página del anunciante.
 *
 * @var array $estilos
 */
$estilos = ['../assets/css/default.css', '../assets/css/anunciante.css'];

/**
 * Título de la página del anunciante.
 *
 * @var string $titulo
 */
$titulo = 'Anunciante | Gasteiz Denda';

/**
 * Archivos de script para la página del anunciante.
 *
 * @var array $scripts
 */
$scripts = ['../assets/js/nav.js'];

// Incluir la vista correspondiente para la página del anunciante
require 'views/anunciante.view.php';
?>
