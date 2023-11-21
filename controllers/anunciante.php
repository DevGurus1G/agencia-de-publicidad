<?php 

include 'db/db_usuarios.php';
include 'db/db_anuncios.php';
include 'db/db_imagenes_anuncios.php';
include 'db/db_categorias.php';
require 'utils/db_common.php';

$anunciante = getUsernameById($_GET['id'],$conn);

$anuncios = getAnunciosByAnunciante($_GET['id'],$conn);
$imagenes = getAllImagenesAnuncio($conn);
$categorias = getAllCategorias($conn);
$anunciantes= getAllUsernameAndId($conn);

$estilos = ['../assets/css/default.css', '../assets/css/anunciante.css'];
$titulo = 'Anunciante | Gasteiz Denda';
$scripts = ['../assets/js/nav.js'];

require 'views/anunciante.view.php';

?>