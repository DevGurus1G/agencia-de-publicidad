<?php
include 'db/db_usuarios.php';
require 'utils/db_common.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function comprobarLogin($email, $password, $conn) {
  $usuario = getUsuarioLogin($email, $conn);
  if ($usuario) {
    if (
      password_verify($password . $usuario['salt'], $usuario['hashed_pass'])
    ) {
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
  $titulo = 'Login | Gasteiz Denda';
  require 'views/login.view.php';
}
?>
