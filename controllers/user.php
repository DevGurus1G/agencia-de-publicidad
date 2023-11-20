<?php
//Para que el filtro de categorias del header funcione
require 'db_common.php';
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);
$estilos = ['assets/css/default.css', 'assets/css/user.css'];
$titulo = 'Panel | Gasteiz Denda';
$scripts = ['assets/js/nav.js'];

require 'views/user.view.php';

?>
