<?php

session_start();

require 'db/db_anuncios.php';
require 'db/db_favoritos.php';
require 'db/db_connection.php';

require 'vendor/autoload.php'; // Asegúrate de ajustar la ruta según tu estructura de directorios
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

$estilos = ['assets/css/default.css', 'assets/css/anuncio.css'];
require 'views/components/header.php';

if (isset($_GET['id'])) {
    $anuncio =  getAnunciosById($_GET['id'], $conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['favorito'] == true)
    {
        insertarFavorito($_SESSION['usuario']['id'] ,$_POST['anuncio'], $conn);
    }else
    {
        borrarFavorito($_SESSION['usuario']['id'] ,$_POST['anuncio'], $conn);
    }

       
    } else {
        $titulo = 'Anuncio | Merkatu Libre';
        $estilos = ['assets/css/default.css', 'assets/css/anuncio.css'];
        require 'views/anuncio.view.php';
}

require 'views/components/footer.php';


?>
