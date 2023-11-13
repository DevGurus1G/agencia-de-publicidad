<?php
function insertUsuario($usuario, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO usuarios (username, pass, email, nombre, apellidos, tipo, imagen) 
    VALUES (:username, :pass, :email, :nombre, :apellidos, :tipo, :imagen)'
  );
  $stmt->execute([
    'username' => $usuario['username'],
    'pass' => $usuario['pass'],
    'email' => $usuario['email'],
    'nombre' => $usuario['nombre'],
    'apellidos' => $usuario['apellidos'],
    'tipo' => $usuario['tipo'],
    'imagen' => $usuario['imagen'],
  ]);
}

function getUsuarioLogin($email, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
  $stmt->execute(['email' => $email]);
  return $stmt->fetch();
}
