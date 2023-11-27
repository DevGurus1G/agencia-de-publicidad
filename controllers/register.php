<?php
include 'db/db_usuarios.php';
require 'utils/db_common.php';
//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';

/**
 * Redirecciona a la página principal si existe un usuario logueado.
 */
if (isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

/**
 * Registra un nuevo usuario en la base de datos.
 *
 * @param resource $conn La conexión a la base de datos.
 *
 * @return void
 */
function registrar($conn) {
  // Obtener el contenido de la imagen del formulario
  $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

  // Encriptar la contraseña
  $options = ['cost' => 12];
  $salt = password_hash(uniqid(mt_rand(), true), PASSWORD_BCRYPT, $options);
  $pass = $_POST['password'];
  $hashed_password = password_hash($pass . $salt, PASSWORD_BCRYPT, $options);

  // Crear un array con la información del usuario
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

  // Insertar el usuario en la base de datos
  insertUsuario($usuario, $conn);

  // Finalizar la ejecución del script
  die('registrado');
}

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Llamar a la función de registro si es una solicitud POST
  registrar($conn);
} else {
  /**
   * Título de la página para la vista de registro.
   *
   * @var string $titulo
   */
  $titulo = 'Register | Gasteiz Denda';

  // Incluir la vista correspondiente para la página de registro
  require 'views/register.view.php';
}
?>
