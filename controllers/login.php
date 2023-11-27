<?php
// Incluir archivos necesarios
include 'db/db_usuarios.php';
require 'utils/db_common.php';

// Para todo lo relacionado a la sesión del usuario
require 'utils/session.php';

/**
 * Verifica si un usuario está logueado y redirecciona a la página de inicio si es así.
 */
if (isset($_SESSION['usuario'])) {
  header('Location: /');
  exit();
}

/**
 * Comprueba el inicio de sesión utilizando el email y la contraseña proporcionados.
 *
 * @param string $email    Email del usuario.
 * @param string $password Contraseña del usuario.
 * @param object $conn     Conexión a la base de datos.
 */
function comprobarLogin($email, $password, $conn) {
  // Obtener información del usuario por su email
  $usuario = getUsuarioLogin($email, $conn);

  if ($usuario) {
    // Verificar la contraseña utilizando la función password_verify
    if (
      password_verify($password . $usuario['salt'], $usuario['hashed_pass'])
    ) {
      // Iniciar sesión y redirigir a la página principal
      $_SESSION['usuario'] = $usuario;
      die('conectado');
    } else {
      die('Contraseña o email incorrecto');
    }
  } else {
    die("$email - Este email no existe");
  }
}

/**
 * Maneja el proceso de inicio de sesión si la solicitud es de tipo POST.
 *
 * Verifica si la solicitud HTTP se ha realizado utilizando el método POST
 * y llama a la función comprobarLogin con los datos del formulario si es así.
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  comprobarLogin($_POST['email'], $_POST['password'], $conn);
} else {
  // Configurar el título y cargar la vista del formulario de inicio de sesión
  $titulo = 'Login | Gasteiz Denda';
  require 'views/login.view.php';
}
?>
