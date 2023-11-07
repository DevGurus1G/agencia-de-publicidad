<?php
require 'db/db_usuarios.php';
require 'db/db_connection.php';

// Para el tipo de autenticacion

if (isset($_POST['tipo'])) {
  $tipo = $_POST['tipo'];
  // Buscar como hacer variables de entorno
  $conn = connect('localhost', 'agencia-de-publicidad', 'root', '');
  if ($tipo === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usuario = getUsuarioLogin($email, $conn);
    // session_start()
    if ($usuario) {
      // para hash de la contras
      //$user_pass = md5($password);
      //$enc_pass = $row['password'];

      if ($password === $usuario['password']) {
        // $_SESSION['usuario_id'] = $usuario['id'];
        echo 'conectado';
      } else {
        echo 'Contraseña o email incorrecto';
      }
    } else {
      echo "$email - Este email no existe";
    }
  } elseif ($tipo === 'registro') {
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $usuario = [
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'email' => $_POST['email'],
      'nombre' => $_POST['nombre'],
      'apellidos' => $_POST['apellidos'],
      'rol' => $_POST['rol'],
      'imagen' => $imagen,
    ];
    insertUsuario($usuario, $conn);
  }
} else {
  require 'views/authenticate.view.php';
}
?>
<script src="authenticate.js"></script>
<?php require 'views/components/footer.php'; ?>
