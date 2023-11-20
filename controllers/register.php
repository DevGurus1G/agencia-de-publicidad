<?php
include 'db/db_connection.php';
include 'db/db_usuarios.php';
require 'db_common.php';

function registrar($conn) {
  $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
  // Encryptar contraseña
  $options = ['cost' => 12];
  $salt = password_hash(uniqid(mt_rand(), true), PASSWORD_BCRYPT, $options);
  $pass = $_POST['password'];
  $hashed_password = password_hash($pass . $salt, PASSWORD_BCRYPT, $options);
  $usuario = [
    'username' => $_POST['username'],
    'hashed_pass' => $hashed_password,
    'salt' => $salt,
    'email' => $_POST['email'],
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    'tipo' => $_POST['tipo'],
    'imagen' => $imagen,
  ];
  insertUsuario($usuario, $conn);
  die('registrado');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  registrar($conn);
} else {
  $titulo = 'Register | Gasteiz Denda';
  $estilos = ['assets/css/auth.css'];
  require 'views/register.view.php';
}
?>
