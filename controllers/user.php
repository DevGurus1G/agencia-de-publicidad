<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if(!isset($_SESSION['usuario'])){
    header("Location: /");
  }
  
//Para que el filtro de categorias del header funcione
require 'utils/db_common.php';
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);
$estilos = ['assets/css/default.css', 'assets/css/user.css'];
$titulo = 'Panel | Gasteiz Denda';
$scripts = ['assets/js/nav.js'];
$tipo = $_SESSION['usuario']['tipo'];
require 'views/user.view.php';

?>
