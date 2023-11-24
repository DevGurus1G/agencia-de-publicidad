<?php 

include 'db/db_usuarios.php';
include 'db/db_anuncios.php';
include 'db/db_imagenes_anuncios.php';
include 'db/db_categorias.php';
require 'utils/db_common.php';
//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';

//Si se intenta acceder sin id o con un id que no sea numerico redirige a la pagina home
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
header("Location: /");
}

$anunciante = getUsernameById($_GET['id'],$conn);
$anuncios = getAnunciosByIdAnuncianteCompletos($_GET['id'],$conn);
$categorias = getAllCategorias($conn);


$estilos = ['../assets/css/default.css', '../assets/css/anunciante.css',];
$titulo = 'Anunciante | Gasteiz Denda';
$scripts = ['../assets/js/nav.js'];

require 'views/anunciante.view.php';

?>