<?php
function insertUsuario($usuario, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO usuarios (username, password, email, nombre, apellidos, rol, imagen) 
    VALUES (:username, :password, :email, :nombre, :apellidos, :rol, :imagen)'
  );
  $stmt->execute([
    'username' => $usuario['username'],
    'password' => $usuario['password'],
    'email' => $usuario['email'],
    'nombre' => $usuario['nombre'],
    'apellidos' => $usuario['apellidos'],
    'rol' => $usuario['rol'],
    'imagen' => $usuario['imagen'],
  ]);
}

function getUsuarioLogin($email, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
  $stmt->execute(['email' => $email]);
  return $stmt->fetch();
}
