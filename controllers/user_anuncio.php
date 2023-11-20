<?php
//Para que el filtro de categorias del header funcione
require 'utils/db_common.php';
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

$estilos = ['../assets/css/default.css', '../assets/css/user_anuncio.css'];
$titulo = 'Gestionar anuncios | Gasteiz Denda';
$scripts = ['../assets/js/nav.js'];
require 'views/user_anuncio.view.php';

?>
