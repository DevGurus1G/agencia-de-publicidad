<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Para la sesión
if (isset($_GET['cerrar'])) {
  unset($_SESSION['usuario']);
  session_destroy();
  header('Location: /');
  exit();
}
if (isset($_SESSION['usuario'])) {
  $usuario_login = $_SESSION['usuario'];
} else {
  $usuario_login = null;
}
if (!isset($_SESSION['usuario'])) {
  $estaLogueado = false;
} else {
  $estaLogueado = true;
  $tipo = $_SESSION['usuario']['tipo'];
}

?>
