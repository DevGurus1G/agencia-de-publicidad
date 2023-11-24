<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
  if (isset($_SESSION['usuario'])) {
    $usuario_login = $_SESSION['usuario'];
    $estaLogueado = true;
    $tipo = $_SESSION['usuario']['tipo'];
  } else {
    $usuario_login = null;
    $estaLogueado = false;
  }
// Para la sesión
if (isset($_GET['cerrar'])) {
  unset($_SESSION['usuario']);
  session_destroy();
  header('Location: /');
  exit();
}
}

?>
