<?php
include 'db/db_usuarios.php';
include 'db/db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
  $conn = connect('localhost', 'agencia-de-publicidad', 'root', '');
  insertUsuario($usuario, $conn);
}

require 'views/register.view.php';
