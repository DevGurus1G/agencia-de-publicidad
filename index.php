<?php
$request_uri = $_SERVER['REQUEST_URI'];

$routes = [
  '/' => 'controllers/home.php',
  '/login' => 'controllers/login.php',
  '/register' => 'controllers/register.php',
  '/anuncio' => 'controllers/anuncio.php',
  '/anuncio/manage' => 'controllers/manage_anuncio.php',
  '/admin' => 'controllers/admin.php',
  '/anuncio/panel' => 'controllers/panel_anuncio.php',
  '/panel' => 'controllers/panel.php',
  '/perfil' => 'controllers/perfil.php',
];

if (array_key_exists($request_uri, $routes)) {
  include $routes[$request_uri];
} else {
  include '404.php';
}
