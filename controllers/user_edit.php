<?php
include 'db/db_usuarios.php';
require 'utils/db_common.php';
//Para que el filtro de categorias del header funcione
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

function editar($conn) {

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    $email = $_SESSION['usuario']['email'];

    $usuarioViejo = getUsuarioLogin($email, $conn);

    $id = $usuarioViejo['id'];

    $passwordActual = $_POST['passwordActual'];

    if (password_verify($passwordActual . $usuarioViejo['salt'], $usuarioViejo['hashed_pass'])) {
        
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        // Encryptar contraseña

        $cambio = $_POST['cambioPassword'];
        if ($cambio == "siCambiar") {
            $options = ['cost' => 12];
            $pass = $_POST['password'];
            $salt = password_hash(uniqid(mt_rand(), true), PASSWORD_BCRYPT, $options);
            $hashed_password = password_hash($pass . $salt, PASSWORD_BCRYPT, $options);
            $usuario = [
                'id' => $id,
                'username' => $_POST['username'],
                'hashed_pass' => $hashed_password,
                'salt' => $salt,
                'email' => $_POST['email'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'imagen' => $imagen,
            ];
            updateUsuarioPassword($usuario, $conn);
            $_SESSION['usuario'] = getUsuarioLogin($usuario['email'],$conn);
            die('editado');
        }else{
            $usuario = [
                'id' => $id,
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'imagen' => $imagen,
                ];
            updateUsuarioNoPassword($usuario, $conn);
            $_SESSION['usuario'] = getUsuarioLogin($usuario['email'],$conn);
            die('editado');
        }
 
    }else{
        die('Contraseña Incorrecta');
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    editar($conn);
} else {
    $estilos = ['../assets/css/default.css', '../assets/css/user_edit.css'];
    $titulo = 'Perfil | Gasteiz Denda';
    $scripts = ['../assets/js/nav.js'];
    require 'views/user_edit.view.php';
}
    

?>
