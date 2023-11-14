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
function registrar($conn) {
  $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
  // Encryptar contraseña
  $options = ['cost' => 12];
  $salt = password_hash(uniqid(mt_rand(), true), PASSWORD_BCRYPT, $options);
  $pass = $_POST['pass'];
  $hashed_password = password_hash($pass . $salt, PASSWORD_BCRYPT, $options);
  $usuario = [
    'username' => $_POST['username'],
    'hashed_pass' => $hashed_password,
    'salt' => $salt,
    'email' => $_POST['email'],
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    'tipo' => $_POST['tipo-usuario'],
    'imagen' => $imagen,
  ];
  insertUsuario($usuario, $conn);
  die('registrado');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  registrar($conn);
} else {
  $titulo = 'Register | Merkatu Libre';
  require 'views/register.view.php';
}
?>
