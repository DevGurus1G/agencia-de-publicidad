<?php
// Para la sesión
if (isset($_GET['cerrar'])) {
  unset($_SESSION['usuario']);
  session_destroy();
  header('Location: /');
  exit();
}
if (!isset($_SESSION['usuario'])) {
  $estaLogueado = false;
} else {
  $estaLogueado = true;
  $tipo = $_SESSION['usuario']['tipo'];
}

?>
