<?php 
require_once 'utils/db_common.php';
require_once 'db/db_categorias.php';
require_once 'vendor/autoload.php';

$conn = connect(
    $_ENV['HOST'],
    $_ENV['DB_NOMBRE'],
    $_ENV['USER'],
    $_ENV['USER_PASSWORD']
  );
  

if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  //Si el que intenta acceder no es un usuario de tipo admin se redirecciona a la pagina principal
  if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != "admin") {
    header("Location: /");
    exit(); 
  }
  

if (isset($_GET['accion'])) {

    $accion = $_GET['accion'];

    $tipo = $_GET['tipo'];

    $id = $_GET['id'];


    if ($accion == 'borrar') {

        switch ($tipo) {
            case 'user':
                deleteUsuariosById($id,$conn);
                break;
        
            case 'anuncio':
                deleteAnuncioById($id,$conn);
                break;
        
            case 'categoria':
                deleteCategoriaById($id,$conn);        
                break;
                
        }
        
    }elseif($accion == 'editar'){
    
    $categorias = getAllCategorias($conn);
    
        switch ($tipo) {
            case 'user':
                
                $campos= [
                    'username' => 'text',
                    'email' => 'email',
                    'nombre'=> 'text' ,
                    'apellidos' => 'text',
                ];
    
                require 'db/db_usuarios.php';
    
                $u = getUsernameById($id,$conn);
    
                $datos = [$u['username'], $u['email'], $u['nombre'], $u['apellidos']];
     
                $titulo = 'Editar Usuario | Gasteiz Denda';
                $scripts = ['../assets/js/nav.js'];
                $estilos = ['../assets/css/default.css'];
    
                $hidden = "<input type='hidden' name='editar_usuario'>";
                $hiddenId = "<input type='hidden' name='id' value=" .  $id .">"; 
    
                require "views/admin_editar.view.php";
    
                break;
        
            case 'categoria':
                
                $campos= [
                    'icono' => 'file',
                    'nombre' => 'text',  
                ];

                $c = getCategoriaNameById($id,$conn);

                $datos = [$c['nombre']];
    
                $titulo = 'Editar Categoría | Gasteiz Denda';
                $scripts = ['../assets/js/nav.js'];
                $estilos = ['../assets/css/default.css'];
    
                $hidden = "<input type='hidden' name='editar_categoria'>";
                $hiddenId = "<input type='hidden' name='id' value=" .  $id .">"; 

                require "views/admin_editar.view.php";
    
                break;
                
        }
    
    }

}



if (isset($_POST['editar_usuario'])) {
    require 'db/db_usuarios.php';

    $usuario = ['id' => $_POST['id'],
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    ];

    updateUsuarioAdmin($usuario,$conn);

    header('Location:/admin');

}

if (isset($_POST['editar_categoria'])) {

    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $categoria = ['id' => $_POST['id'],
    'imagen' => $imagen,
    'nombre' => $_POST['nombre'],
    
    ];

    updateCategoria($categoria,$conn);

    header('Location:/admin');

}

?>