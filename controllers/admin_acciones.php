<?php 
require 'utils/db_common.php';
require_once 'db/db_categorias.php';



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



if (isset($_GET['editar_usuario'])) {
    require 'db/db_usuarios.php';

    $usuario = ['id' => $_GET['id'],
    'username' => $_GET['username'],
    'email' => $_GET['email'],
    'nombre' => $_GET['nombre'],
    'apellidos' => $_GET['apellidos'],
    ];

    updateUsuarioAdmin($usuario,$conn);

    header('Location:/admin');

}

if (isset($_GET['editar_categoria'])) {


    $categoria = ['id' => $_GET['id'],
    'nombre' => $_GET['nombre'],
    
    ];

    updateCategoria($categoria,$conn);

    header('Location:/admin');

}

?>