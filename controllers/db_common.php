<?php
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
