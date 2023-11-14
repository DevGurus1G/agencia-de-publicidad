<?php
function insertUsuario($usuario, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO usuarios (username, hashed_pass, salt, email, nombre, apellidos, tipo, imagen) 
    VALUES (:username, :hashed_pass, :salt, :email, :nombre, :apellidos, :tipo, :imagen)'
  );
  $stmt->execute([
    'username' => $usuario['username'],
    'hashed_pass' => $usuario['hashed_pass'],
    'salt' => $usuario['salt'],
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
