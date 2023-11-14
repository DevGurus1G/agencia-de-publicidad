<?php
include 'db/db_connection.php';
include 'db/db_usuarios.php';
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
function comprobarLogin($email, $password, $conn) {
  $usuario = getUsuarioLogin($email, $conn);
  if ($usuario) {
    if (
      password_verify($password . $usuario['salt'], $usuario['hashed_pass'])
    ) {
      session_start();
      $_SESSION['usuario'] = $usuario;
      die('conectado');
    } else {
      die('Contraseña o email incorrecto');
    }
  } else {
    die("$email - Este email no existe");
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  comprobarLogin($_POST['email'], $_POST['password'], $conn);
} else {
  $titulo = 'Login | Merkatu Libre';
  $estilos = ['assets/css/auth.css'];
  require 'views/login.view.php';
}
?>
