<?php
//Para que el filtro de categorias del header funcione
require 'utils/db_common.php';
require 'db/db_categorias.php';
require 'db/db_anuncios.php';
require 'db/db_usuarios.php';
require 'utils/session.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

//Si el que intenta acceder no es un usuario de tipo tienda se redirecciona a la pagina principal
if($_SESSION['usuario']['tipo'] != "admin") {
  header("Location: /");
  exit(); 
}

$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : '';

if (!empty($tabla)) {
  switch ($tabla) {
    case 'Usuarios':
      $tablas = getUsuariosByTipo('comprador', $conn);
      break;

    case 'Empresas':
      $tablas = getUsuariosByTipo('tienda', $conn);
      break;

    case 'Anuncios':
      $tablas = getAllAnuncios($conn);
      break;

    case 'Categorias':
      $tablas = getAllCategorias($conn);
      break;
  }
} else {
  $cadena = 'No se ha especificado una tabla válida.';
}

switch ($tabla) {
  case 'Usuarios':
  case 'Empresas':
    $cadena =
      '<table><tr><th>Username</th><th>Nombre</th><th>Apellido</th><th>Tipo</th><th>Email</th><th>Acciones</th></tr>';

    foreach ($tablas as $celda) {
      $cadena .= '<tr>';
      $cadena .= '<td>' . $celda['username'] . '</td>';
      $cadena .= '<td>' . $celda['nombre'] . '</td>';
      $cadena .= '<td>' . $celda['apellidos'] . '</td>';
      $cadena .= '<td>' . $celda['tipo'] . '</td>';
      $cadena .= '<td>' . $celda['email'] . '</td>';
      $cadena .=
        "<td><a href='/admin/editar?accion=editar&tipo=user&id=" .
        $celda['id'] .
        "'><svg class='icon' width='36' height='36' viewBox='0 0 36 36' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M28.95 13.3875L22.575 7.0875L24.675 4.9875C25.25 4.4125 25.9565 4.125 26.7945 4.125C27.6325 4.125 28.3385 4.4125 28.9125 4.9875L31.0125 7.0875C31.5875 7.6625 31.8875 8.3565 31.9125 9.1695C31.9375 9.9825 31.6625 10.676 31.0875 11.25L28.95 13.3875ZM26.775 15.6L10.875 31.5H4.5V25.125L20.4 9.225L26.775 15.6Z' fill='#13C1AC'/>
        </svg></a>" .
        ' ' .
        "<a href='/admin?accion=borrar&tipo=user&id=" .
        $celda['id'] .
        "'><svg class='icon' width='36' height='36' viewBox='0 0 36 36' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M13.5 4.5V6H6V9H7.5V28.5C7.5 29.2956 7.81607 30.0587 8.37868 30.6213C8.94129 31.1839 9.70435 31.5 10.5 31.5H25.5C26.2956 31.5 27.0587 31.1839 27.6213 30.6213C28.1839 30.0587 28.5 29.2956 28.5 28.5V9H30V6H22.5V4.5H13.5ZM13.5 12H16.5V25.5H13.5V12ZM19.5 12H22.5V25.5H19.5V12Z' fill='#13C1AC'/>
        </svg></a></td>";
      $cadena .= '</tr>';
    }

    $cadena .= '</table>';

    echo $cadena;

    break;

  case 'Anuncios':
    $cadena =
      '<table><tr><th>Titulo</th><th>Descripción</th><th>Precio</th><th>Anunciante</th><th>Categoria</th><th>Acciones</th></tr>';

    foreach ($tablas as $celda) {
      $cadena .= '<tr>';
      $cadena .= '<td>' . $celda['titulo'] . '</td>';
      $cadena .= '<td>' . $celda['descripcion'] . '</td>';
      $cadena .= '<td>' . $celda['precio'] . '</td>';
      $cadena .= '<td>' . $celda['nombre_anunciante'] . '</td>';
      $cadena .= '<td>' . $celda['nombre_categoria'] . '</td>';
      $cadena .=
        "<td><a href='/admin?accion=borrar&tipo=anuncio&id=" .
        $celda['anuncio_id'] .
        "'><svg class='icon' width='36' height='36' viewBox='0 0 36 36' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M13.5 4.5V6H6V9H7.5V28.5C7.5 29.2956 7.81607 30.0587 8.37868 30.6213C8.94129 31.1839 9.70435 31.5 10.5 31.5H25.5C26.2956 31.5 27.0587 31.1839 27.6213 30.6213C28.1839 30.0587 28.5 29.2956 28.5 28.5V9H30V6H22.5V4.5H13.5ZM13.5 12H16.5V25.5H13.5V12ZM19.5 12H22.5V25.5H19.5V12Z' fill='#13C1AC'/>
        </svg></a></td>";
      $cadena .= '</tr>';
    }

    $cadena .= '</table>';

    echo $cadena;

    break;

  case 'Categorias':
    $cadena = '<table><tr><th>Nombre</th><th>Acciones</th></tr>';

    foreach ($tablas as $celda) {
      $cadena .= '<tr>';
      $cadena .= '<td>' . $celda['nombre'] . '</td>';
      $cadena .=
        "<td><a href='/admin/editar?accion=editar&tipo=categoria&id=" .
        $celda['id'] .
        "'><svg class='icon' width='36' height='36' viewBox='0 0 36 36' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M28.95 13.3875L22.575 7.0875L24.675 4.9875C25.25 4.4125 25.9565 4.125 26.7945 4.125C27.6325 4.125 28.3385 4.4125 28.9125 4.9875L31.0125 7.0875C31.5875 7.6625 31.8875 8.3565 31.9125 9.1695C31.9375 9.9825 31.6625 10.676 31.0875 11.25L28.95 13.3875ZM26.775 15.6L10.875 31.5H4.5V25.125L20.4 9.225L26.775 15.6Z' fill='#13C1AC'/>
        </svg>
        </a>" .
        ' ' .
        "<a href='/admin?accion=borrar&tipo=categoria&id=" .
        $celda['id'] .
        "'><svg class='icon' width='36' height='36' viewBox='0 0 36 36' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M13.5 4.5V6H6V9H7.5V28.5C7.5 29.2956 7.81607 30.0587 8.37868 30.6213C8.94129 31.1839 9.70435 31.5 10.5 31.5H25.5C26.2956 31.5 27.0587 31.1839 27.6213 30.6213C28.1839 30.0587 28.5 29.2956 28.5 28.5V9H30V6H22.5V4.5H13.5ZM13.5 12H16.5V25.5H13.5V12ZM19.5 12H22.5V25.5H19.5V12Z' fill='#13C1AC'/>
        </svg>
        </a></td>";
      $cadena .= '</tr>';
    }

    $cadena .= '</table>';

    echo $cadena;

    break;
  default:
    $estilos = ['assets/css/default.css', 'assets/css/admin.css'];
    $titulo = 'Admin | Gasteiz Denda';
    $scripts = ['assets/js/nav.js', 'assets/js/admin.js'];
    require 'views/admin.view.php';
    $cadena = 'Ninguna tabla seleccionada.';

    break;
}

function realizarAccion(){

  require 'admin_acciones.php';
}

if (isset($_GET['accion'])) {
  realizarAccion();
}

?>
