<?php
session_start();
include 'db/db_anuncios.php';
include 'db/db_connection.php';
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$titulo = 'Home | Gasteiz Denda';
$scripts = ['assets/js/nav.js'];
$estilos = ['assets/css/default.css'];

$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

$anuncios = getAllAnuncios($conn);
require 'session.php';
include 'views/home.view.php';
?>
