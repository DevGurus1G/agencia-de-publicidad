<?php
$request_uri = $_SERVER['REQUEST_URI'];

$routes = [
  '/' => 'controllers/home.php',
  '/login' => 'login.php',
  '/register' => 'register.php',
];

if (array_key_exists($request_uri, $routes)) {
  include $routes[$request_uri];
} else {
  include '404.php';
}
