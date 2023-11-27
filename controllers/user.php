<?php

// Redirige a la página principal si no hay un usuario logueado
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

// Incluir el archivo para la gestión de sesiones de usuario
require 'utils/session.php';

// Obtener todas las categorías para el filtro del encabezado
require 'utils/db_common.php';
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

/**
 * Estilos para la página del panel de usuario.
 *
 * @var array $estilos
 */
$estilos = ['assets/css/default.css', 'assets/css/user.css'];

/**
 * Título de la página del panel de usuario.
 *
 * @var string $titulo
 */
$titulo = 'Panel | Gasteiz Denda';

/**
 * Archivos de script para la página del panel de usuario.
 *
 * @var array $scripts
 */
$scripts = ['assets/js/nav.js'];

/**
 * Tipo de usuario actual.
 *
 * @var string $tipo
 */
$tipo = $_SESSION['usuario']['tipo'];

// Incluir la vista correspondiente para la página del panel de usuario
require 'views/user.view.php';
?>
