<?php
session_start();
$request_uri_entera = $_SERVER['REQUEST_URI'];

$request_uri_array = explode('?', $request_uri_entera);

$request_uri = $request_uri_array[0];

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

$routes_login = [
  '/anuncio/manage' => 'controllers/manage_anuncio.php',
  '/admin' => 'controllers/admin.php',
  '/user/anuncio' => 'controllers/user_anuncio.php',
  '/user' => 'controllers/user.php',
  '/user/edit' => 'controllers/user_edit.php',
  '/chat' => 'controllers/chat.php',
  '/anunciante' => 'controllers/anunciante.php',
  '/admin/editar' => 'controllers/admin_acciones.php',
  '/admin/insertar' => 'controllers/admin_insertar.php',
];

$routes_nologin = [
  '/' => 'controllers/home.php',
  '/login' => 'controllers/login.php',
  '/register' => 'controllers/register.php',
  '/anuncio' => 'controllers/anuncio.php',
];

if (array_key_exists($request_uri, $routes)) {
  if (isset($_SESSION['usuario'])) {
    include $routes[$request_uri];
  } else {
    include $routes_nologin[$request_uri];
  }
} else {
  include '404.php';
}
