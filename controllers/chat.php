<?php
include 'db/db_chat.php';
require 'utils/db_common.php';
require 'db/db_categorias.php';
// Para todo lo relacionado a la sesión del usuario
require 'utils/session.php';

// Si no existe un usuario logueado, se redirecciona a home
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

/**
 * Título de la página.
 *
 * @var string $titulo
 */
$titulo = 'Chats | Gasteiz Denda';

/**
 * Estilos CSS utilizados en la página.
 *
 * @var array $estilos
 */
$estilos = ['assets/css/default.css', 'assets/css/chat.css'];

/**
 * Scripts JavaScript utilizados en la página.
 *
 * @var array $scripts
 */
$scripts = ['assets/js/nav.js'];

/**
 * Obtiene los chats del usuario.
 *
 * @var array $chats
 */
$chats = getUserChats($conn, $_SESSION['usuario']['id']);

/**
 * ID del usuario conectado.
 *
 * @var int $usuario_conectado
 */
$usuario_conectado = $_SESSION['usuario']['id'];

/**
 * Obtiene todas las categorías disponibles.
 *
 * @var array $categorias
 */
$categorias = getAllCategorias($conn);

/**
 * Incluye la vista de la página de chat.
 */
require 'views/chat.view.php';
?>
