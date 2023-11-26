<?php 

require 'db/db_categorias.php';
require 'utils/db_common.php';
//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';
  
  //Si el que intenta acceder no es un usuario de tipo admin se redirecciona a la pagina principal
  if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != "admin") {
    header("Location: /");
    exit(); 
  }

if (isset($_GET['tipo'])) {

    $tipo = $_GET['tipo'];

    if ($tipo == 'user') {

        $categorias = getAllCategorias($conn);           
                    
        $campos= [
            'nombre' => 'text',
            'apellidos' => 'text',
            'username' => 'text',
            'email' => 'email', 
        ];
    
        $titulo = 'Insertar Usuario | Gasteiz Denda';
        $scripts = ['../assets/js/nav.js'];
        $estilos = ['../assets/css/default.css','../assets/css/admin_acciones.css'];
    
        $hidden = "<input type='hidden' name='insertar_usuario'>";

        require "views/admin_insertar.view.php";
        
    }elseif($tipo == 'categoria'){
    
        $categorias = getAllCategorias($conn);           
                    
        $campos= [
            'icono' => 'file',
            'nombre' => 'text',  
        ];
    
        $titulo = 'Insertar Categoría | Gasteiz Denda';
        $scripts = ['../assets/js/nav.js','../assets/js/admin_insertar_categoria.js'];
        $estilos = ['../assets/css/default.css','../assets/css/admin_acciones.css'];
    
        $hidden = "<input type='hidden' name='insertar_categoria'>";

        require "views/admin_insertar.view.php";
    
    }

}

if (isset($_POST['insertar_usuario'])) {
    require 'db/db_usuarios.php';
    $rutaImagen = 'assets/img/default_avatar.webp';
    $imagen = file_get_contents($rutaImagen);
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

if (isset($_POST['categoria'])) {

    $categoria = ['nombre' => $_POST['nombre']];

    $categoria['imagen'] = file_get_contents($_FILES['imagen']['tmp_name']);;

    insertCategoria($categoria,$conn);

    die('CategoriaInsertada');

}

?>