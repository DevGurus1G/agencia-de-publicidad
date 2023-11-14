<?php

// Las rutas hay que ponerlas como si fuera el index
include 'db/db_anuncios.php';
include 'db/db_connection.php';

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();
// Cargar todos los anuncios
$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

$anuncios = getAllAnuncios($conn);
include 'views/home.view.php';
?>
