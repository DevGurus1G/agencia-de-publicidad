<?php
include 'db/db_chat.php';
require 'utils/db_common.php';
require 'db/db_categorias.php';
//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';
  
  //Si no existe un usuario logueado se redirecciona a home
  if(!isset($_SESSION['usuario'])){
    header("Location: /");
    exit();
  }

$titulo = 'Chats | Gasteiz Denda';
$estilos = ['assets/css/default.css', 'assets/css/chat.css'];
$scripts = ['assets/js/nav.js'];
$chats = getUserChats($conn, $_SESSION['usuario']['id']);
$usuario_conectado = $_SESSION['usuario']['id'];
$categorias = getAllCategorias($conn);
// print_r($chats);
require 'views/chat.view.php';
?>
