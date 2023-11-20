<?php $estilos = ['/assets/css/default.css', '/assets/css/404.css'];
$titulo = 'Error | Gasteiz Denda';
$scripts = ['/assets/js/nav.js'];
//Para que el filtro de categorias del header funcione
require 'controllers/db_common.php';
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);
require 'views/components/header.php';
?>

<main>
    <p class="mensaje">
        Ups, algo ha salido mal...
        <span class="error">
            Error 404
        </span>
        &mdash; Esta pagina no existe &mdash;
    </p>
</main>

<?php require 'views/components/footer.php'; ?>


