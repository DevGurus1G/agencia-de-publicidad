<?php
$request_uri_entera = $_SERVER['REQUEST_URI'];

$request_uri_array = explode("?",$request_uri_entera);

$request_uri = $request_uri_array[0];

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
  print_r($request_uri);
}
