<?php
include 'db/db_usuarios.php';
require 'utils/db_common.php';
//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';

//Si existe un usuario logueado se redirecciona a home
if(isset($_SESSION['usuario'])){
  header("Location: /");
  exit();
}

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
  require 'views/register.view.php';
}
?>
