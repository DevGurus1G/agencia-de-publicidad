<?php
require 'db/db_anuncios.php';
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

  registrar($conn);