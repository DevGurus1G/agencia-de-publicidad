<?php
//Para que el filtro de categorias del header funcione
require 'utils/db_common.php';
require 'db/db_categorias.php';
require 'db/db_anuncios.php';
require 'db/db_usuarios.php';
$categorias = getAllCategorias($conn);
require 'utils/session.php';

$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : '';


if (!empty($tabla)) {
        switch ($tabla) {
            case 'Usuarios':
                $tablas = getUsuariosByTipo('comprador',$conn);
                break;
        
            case 'Empresas':
                $tablas = getUsuariosByTipo( 'vendedor',$conn);
                break;
        
            case 'Anuncios':
                $tablas = getAllAnuncios($conn);
                break;
        
            case 'Categorias':
                $tablas = getAllCategorias($conn);
                break;
        }
}else {
    
    $cadena = 'No se ha especificado una tabla válida.';
}

switch ($tabla) {
    case 'Usuarios':
    case 'Empresas':
        $cadena = "<table><tr><th>Username</th><th>Nombre</th><th>Apellido</th><th>Tipo</th><th>Email</th><th>Acciones</th></tr>";

        foreach ($tablas as $celda) {
            $cadena .= "<tr>";
            $cadena .= "<td>" . $celda["username"] . "</td>";
            $cadena .= "<td>" . $celda["nombre"] . "</td>";
            $cadena .= "<td>" . $celda["apellidos"] . "</td>";
            $cadena .= "<td>" . $celda["tipo"] . "</td>";
            $cadena .= "<td>" . $celda["email"] . "</td>";
            $cadena .= "<td><a href='/admin/editar?tipo=user&id=" . $celda['id'] . "'>Editar</a>" . " " ."<a href='/admin/borrar?tipo=user&id=" . $celda['id'] . "'>Borrar</a></td>";
            $cadena .= "</tr>";
        }

        $cadena .= "</table>";

        echo $cadena;

        break;

    case 'Anuncios':
        $cadena = "<table><tr><th>Titulo</th><th>Descripción</th><th>Precio</th><th>Id-Anunciante</th><th>Id-Categoria</th><th>Acciones</th></tr>";

        foreach ($tablas as $celda) {
            $cadena .= "<tr>";
            $cadena .= "<td>" . $celda["titulo"] . "</td>";
            $cadena .= "<td>" . $celda["descripcion"] . "</td>";
            $cadena .= "<td>" . $celda["precio"] . "</td>";
            $cadena .= "<td>" . $celda["anunciante"] . "</td>";
            $cadena .= "<td>" . $celda["categoria_id"] . "</td>";
            $cadena .= "<td><a href='/admin/borrar?tipo=anuncio&id=" . $celda['id'] . "'>Borrar</a></td>";
            $cadena .= "</tr>";
        }

        $cadena .= "</table>";

        echo $cadena;

        break;

    case 'Categorias':
        $cadena = "<table><tr><th>Nombre</th><th>Acciones</th></tr>";

        foreach ($tablas as $celda) {
            $cadena .= "<tr>";
            $cadena .= "<td>" . $celda["nombre"] . "</td>";
            $cadena .= "<td><a href='/admin/borrar?tipo=categoria&id=" . $celda['id'] . "'>Editar</a>" . " " . "<a href='/admin/borrar?tipo=categoria&id=" . $celda['id'] . "'>Borrar</a></td>";
            $cadena .= "</tr>";
        }

        $cadena .= "</table>";

        echo $cadena;        

        break;
    default:

        $estilos = ['assets/css/default.css', 'assets/css/admin.css'];
        $titulo = 'Admin | Gasteiz Denda';
        $scripts = ['assets/js/nav.js','assets/js/admin.js'];
        require 'views/admin.view.php';
        $cadena = "Ninguna tabla seleccionada.";

        break;
    }



?>
