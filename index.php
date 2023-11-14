<?php
$request_uri = $_SERVER['REQUEST_URI'];

$routes = [
  '/' => 'controllers/home.php',
  '/login' => 'controllers/login.php',
  '/register' => 'controllers/register.php',
  '/anuncios' => 'controllers/anuncios.php',
  '/anuncioRegistro' => "./configAnuncio.php",
];

if (array_key_exists($request_uri, $routes)) {
  include $routes[$request_uri];
} else {
  include '404.php';
}
