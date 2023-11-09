<?php
require 'db/db_usuarios.php';
require 'db/db_connection.php';

// Para el tipo de autenticacion

$tipo = $_POST['tipo'];

$conn = connect('localhost', 'agencia-de-publicidad', 'root', '');
if (tipoPeticion($tipo) === 0) {
  comprobarLogin($_POST['email'], $_POST['password'], $conn);
} elseif (tipoPeticion($tipo) === 1) {
  registrar($conn);
} else {
  require 'views/authenticate.view.php';
}

function tipoPeticion($tipo) {
  if ($tipo === 'login') {
    return 0;
  } elseif ($tipo === 'registro') {
    return 1;
  } else {
    return 2;
  }
}

function comprobarLogin($email, $password, $conn) {
  $usuario = getUsuarioLogin($email, $conn);
  // session_start()
  if ($usuario) {
    // para hash de la contras
    //$user_pass = md5($password);
    //$enc_pass = $row['password'];

    if ($password === $usuario['password']) {
      // $_SESSION['usuario_id'] = $usuario['id'];
      die('conectado');
    } else {
      die('Contraseña o email incorrecto');
    }
  } else {
    die("$email - Este email no existe");
  }
}

function registrar($conn) {
  $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
  $usuario = [
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'email' => $_POST['email'],
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    'rol' => $_POST['tipoUsuario'],
    'imagen' => $imagen,
  ];
  insertUsuario($usuario, $conn);
  die('registrado');
}
?>
