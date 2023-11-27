<?php
include 'db/db_usuarios.php';
require 'utils/db_common.php';
//Para que el filtro de categorias del header funcione
require 'db/db_categorias.php';
$categorias = getAllCategorias($conn);

//Para todo lo relacionado a la sesion del usuario
require 'utils/session.php';

/**
 * Redirige a la página principal si no hay un usuario logueado.
 */
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

/**
 * Realiza la edición del perfil del usuario.
 *
 * @param resource $conn La conexión a la base de datos.
 *
 * @return void
 */
function editar($conn) {
  // Iniciar la sesión si no está iniciada
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

<<<<<<< HEAD
$usuario = $_SESSION['usuario'];

function editar($conn) {
=======
  // Obtener el correo electrónico del usuario
  $email = $_SESSION['usuario']['email'];
>>>>>>> feature-doc-php

  // Obtener la información del usuario antes de la edición
  $usuarioViejo = getUsuarioLogin($email, $conn);

  // Obtener el ID del usuario
  $id = $usuarioViejo['id'];

  // Obtener la contraseña actual del formulario
  $passwordActual = $_POST['passwordActual'];

  // Verificar si la contraseña actual es correcta
  if (
    password_verify(
      $passwordActual . $usuarioViejo['salt'],
      $usuarioViejo['hashed_pass']
    )
  ) {
    // Obtener el contenido de la nueva imagen del formulario
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    // Verificar si se desea cambiar la contraseña
    $cambio = $_POST['cambioPassword'];

    if ($cambio == 'siCambiar') {
      // Encriptar la nueva contraseña
      $options = ['cost' => 12];
      $pass = $_POST['password'];
      $salt = password_hash(uniqid(mt_rand(), true), PASSWORD_BCRYPT, $options);
      $hashed_password = password_hash(
        $pass . $salt,
        PASSWORD_BCRYPT,
        $options
      );

      // Crear un array con la información del usuario actualizado
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

      // Actualizar la información del usuario con la nueva contraseña
      updateUsuarioPassword($usuario, $conn);

      // Actualizar la sesión con la información del usuario actualizada
      $_SESSION['usuario'] = getUsuarioLogin($usuario['email'], $conn);

      // Finalizar la ejecución del script
      die('editado');
    } else {
      // Crear un array con la información del usuario actualizado sin cambiar la contraseña
      $usuario = [
        'id' => $id,
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'imagen' => $imagen,
      ];

      // Actualizar la información del usuario sin cambiar la contraseña
      updateUsuarioNoPassword($usuario, $conn);

      // Actualizar la sesión con la información del usuario actualizada
      $_SESSION['usuario'] = getUsuarioLogin($usuario['email'], $conn);

      // Finalizar la ejecución del script
      die('editado');
    }
  } else {
    // Finalizar la ejecución del script si la contraseña actual es incorrecta
    die('Contraseña Incorrecta');
  }
}

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Llamar a la función de edición si es una solicitud POST
  editar($conn);
} else {
  /**
   * Estilos para la página de edición de perfil de usuario.
   *
   * @var array $estilos
   */
  $estilos = ['../assets/css/default.css', '../assets/css/user_edit.css'];

  /**
   * Título de la página de edición de perfil de usuario.
   *
   * @var string $titulo
   */
  $titulo = 'Perfil | Gasteiz Denda';

  /**
   * Archivos de script para la página de edición de perfil de usuario.
   *
   * @var array $scripts
   */
  $scripts = ['../assets/js/nav.js'];

  // Incluir la vista correspondiente para la página de edición de perfil de usuario
  require 'views/user_edit.view.php';
}
?>
