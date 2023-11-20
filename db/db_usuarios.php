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

function updateUsuarioPassword($usuario, $conn) {
  $stmt = $conn->prepare(
    'UPDATE  usuarios 
     SET username = :username , hashed_pass = :hashed_pass , salt = :salt , nombre = :nombre , apellidos = :apellidos , email = :email, imagen = :imagen 
     WHERE id = :id'
  );

  $stmt->execute([
    'id' => $usuario['id'],
    'username' => $usuario['username'],
    'hashed_pass' => $usuario['hashed_pass'],
    'salt' => $usuario['salt'],
    'email' => $usuario['email'],
    'nombre' => $usuario['nombre'],
    'apellidos' => $usuario['apellidos'],
    'imagen' => $usuario['imagen'],
  ]);
}

function updateUsuarioNoPassword($usuario, $conn) {
  $stmt = $conn->prepare(
    'UPDATE  usuarios 
     SET username = :username , nombre = :nombre , apellidos = :apellidos , email = :email, imagen = :imagen 
     WHERE id = :id'
  );

  $stmt->execute([
    'id' => $usuario['id'],
    'username' => $usuario['username'],
    'email' => $usuario['email'],
    'nombre' => $usuario['nombre'],
    'apellidos' => $usuario['apellidos'],
    'imagen' => $usuario['imagen'],
  ]);
}

function getUsuarioLogin($email, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
  $stmt->execute(['email' => $email]);
  return $stmt->fetch();
}

function getUsernameById($id, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}

function getAllUsernameAndId($conn) {
  $stmt = $conn->prepare('SELECT id,username FROM usuarios');
  $stmt->execute();
  return $stmt->fetchAll();
}
