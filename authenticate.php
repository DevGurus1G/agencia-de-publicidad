<?php
require 'db/db_usuarios.php';
require 'db/db_connection.php';

// Para el tipo de autenticacion

require 'vendor/autoload.php'; // Asegúrate de ajustar la ruta según tu estructura de directorios
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$conn = connect(
  $_ENV['HOST'],
  $_ENV['DB_NOMBRE'],
  $_ENV['USER'],
  $_ENV['USER_PASSWORD']
);
$tipo = $_POST['tipo'];
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
  print_r($_FILES['imagen']);
  $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
  $usuario = [
    'username' => $_POST['username'],
    'pass' => $_POST['password'],
    'email' => $_POST['email'],
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    'tipo' => 'comprador',
    'imagen' => $imagen,
  ];
  insertUsuario($usuario, $conn);
  die('registrado');
}
?>
