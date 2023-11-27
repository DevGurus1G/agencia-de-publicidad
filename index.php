<?php
// Iniciar la sesión
session_start();

// Obtener la URI completa de la solicitud
$request_uri_entera = $_SERVER['REQUEST_URI'];

// Dividir la URI en partes para manejar parámetros de consulta
$request_uri_array = explode('?', $request_uri_entera);

// Tomar solo la ruta principal sin parámetros de consulta
$request_uri = $request_uri_array[0];

/**
 * Rutas y sus controladores asociados.
 *
 * @var array $routes
 */
$routes = [
  '/' => 'controllers/home.php',
  '/login' => 'controllers/login.php',
  '/register' => 'controllers/register.php',
  '/anuncio' => 'controllers/anuncio.php',
  '/anuncio/manage' => 'controllers/manage_anuncio.php',
  '/admin' => 'controllers/admin.php',
  '/user/anuncio' => 'controllers/user_anuncio.php',
  '/user' => 'controllers/user.php',
  '/user/edit' => 'controllers/user_edit.php',
  '/chat' => 'controllers/chat.php',
  '/chat/conversation' => 'controllers/chat_conversation.php',
  '/anunciante' => 'controllers/anunciante.php',
  '/admin/editar' => 'controllers/admin_acciones.php',
  '/admin/insertar' => 'controllers/admin_insertar.php',
];

// Verificar si la ruta solicitada existe en las rutas definidas
if (array_key_exists($request_uri, $routes)) {
  // Incluir el controlador correspondiente según la ruta solicitada
  include $routes[$request_uri];
} else {
  // Si la ruta no existe, incluir la página de error 404
  include '404.php';
}
?>
