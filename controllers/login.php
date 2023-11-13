<?php
function comprobarLogin($email, $password, $conn) {
  $usuario = getUsuarioLogin($email, $conn);
  // session_start()
  if ($usuario) {
    // para hash de la contras
    //$user_pass = md5($password);
    //$enc_pass = $row['password'];

    if ($password === $usuario['password']) {
      $_SESSION[$usuario] = $usuario;
      die('conectado');
    } else {
      die('Contraseña o email incorrecto');
    }
  } else {
    die("$email - Este email no existe");
  }
}
?>
