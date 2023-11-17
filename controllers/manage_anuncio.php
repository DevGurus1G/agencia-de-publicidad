<?php

require 'db/db_anuncios.php';
require 'db/db_categorias.php';
require 'db/db_imagenes_anuncios.php';
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
  if (!isset($_SESSION)) {
    session_start();
  }
  $usuarioId = $_SESSION['usuario']['id'];
  $anuncio = [
    'titulo' => $_POST['titulo'],
    'descripcion' => $_POST['descripcion'],
    'precio' => $_POST['precio'],
    'anunciante' => $usuarioId,
    'categoria' => $_POST['categoria'],
  ];
  $anuncioId = insertAnuncio($anuncio, $conn);
  agregarFotos($anuncioId,$conn);
  die('registrado');
}

function agregarFotos($anuncioId,$conn){
  $imagen1 = file_get_contents($_FILES['imagen1']['tmp_name']);
  $imagen2 = file_get_contents($_FILES['imagen2']['tmp_name']);
  $imagen3 = file_get_contents($_FILES['imagen3']['tmp_name']);
  insertImagenAnuncio($imagen1,$anuncioId,$conn);
  insertImagenAnuncio($imagen2,$anuncioId,$conn);
  insertImagenAnuncio($imagen3,$anuncioId,$conn);
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
