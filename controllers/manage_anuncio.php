<?php

require 'db/db_anuncios.php';
require 'db/db_categorias.php';
require 'db/db_connection.php';
require 'vendor/autoload.php'; // Asegúrate de ajustar la ruta según tu estructura de directorios

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

$estilos = ['../assets/css/default.css', '../assets/css/manage_anuncio.css'];

function registrar($conn) {
  // print_r($_FILES['imagen']);
  // $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
  $anuncio = [
    'titulo' => $_POST['titulo'],
    'descripcion' => $_POST['descripcion'],
    'precio' => $_POST['precio'],
    'anunciante' => 1,
    'categoria' => $_POST['categoria'],
  ];
  insertAnuncio($anuncio, $conn);
  die('registrado');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  registrar($conn);
} else {
  $titulo = 'Registro anuncio | Gasteiz Denda';
  $scripts = ['../assets/js/nav.js', '../assets/js/manage_anuncio.js'];
  $estilos = ['../assets/css/default.css', '../assets/css/manage_anuncio.css'];
  $categorias = getAllCategorias($conn);

  require 'views/manage_anuncio.view.php';
}

?>
