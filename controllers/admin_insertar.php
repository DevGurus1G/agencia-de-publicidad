<?php 

require 'db/db_connection.php';
require 'vendor/autoload.php';
require 'db/db_categorias.php';

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();
// Cargar todos los anuncios
$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);

if (isset($_GET['tipo'])) {

    $tipo = $_GET['tipo'];

    if ($tipo == 'user') {

        $categorias = getAllCategorias($conn);           
                    
        $campos= [
            'imagen' => 'file',
            'nombre' => 'text',
            'apellidos' => 'text',
            'username' => 'text',
            'email' => 'email', 
        ];
    
        $titulo = 'Insertar Usuario | Gasteiz Denda';
        $scripts = ['../assets/js/nav.js'];
        $estilos = ['../assets/css/default.css'];
    
        $hidden = "<input type='hidden' name='insertar_usuario'>";

        require "views/admin_insertar.view.php";
        
    }elseif($tipo == 'categoria'){
    
        $categorias = getAllCategorias($conn);           
                    
        $campos= [
            'icono' => 'file',
            'nombre' => 'text',  
        ];
    
        $titulo = 'Insertar Categoría | Gasteiz Denda';
        $scripts = ['../assets/js/nav.js'];
        $estilos = ['../assets/css/default.css'];
    
        $hidden = "<input type='hidden' name='insertar_categoria'>";

        require "views/admin_insertar.view.php";
    
    }

}

if (isset($_POST['insertar_usuario'])) {
    require 'db/db_usuarios.php';
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $options = ['cost' => 12];
    $salt = password_hash(uniqid(mt_rand(), true), PASSWORD_BCRYPT, $options);
    $pass = $_POST['password'];
    $hashed_password = password_hash($pass . $salt, PASSWORD_BCRYPT, $options);
    $usuario = [
        'username' => $_POST['username'],
        'hashed_pass' => $hashed_password,
        'salt' => $salt,
        'email' => $_POST['email'],
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'tipo' => $_POST['tipo'],
        'imagen' => $imagen,
      ];

    insertUsuario($usuario,$conn);

    header('Location:/admin');

}

if (isset($_POST['insertar_categoria'])) {

    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $categoria = ['nombre' => $_POST['nombre'],
        'imagen' => $imagen,
    ];

    insertCategoria($categoria,$conn);

    header('Location:/admin');

}

?>