<?php
/**
 * Inserta un nuevo usuario en la base de datos.
 *
 * @param array $usuario Los datos del usuario a insertar.
 * @param PDO   $conn    El objeto PDO que representa la conexión a la base de datos.
 */
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

/**
 * Inserta un nuevo usuario administrador en la base de datos.
 *
 * @param array $usuario Los datos del usuario administrador a insertar.
 * @param PDO   $conn    El objeto PDO que representa la conexión a la base de datos.
 */
function insertUsuarioAdmin($usuario, $conn) {
  $stmt = $conn->prepare(
    'INSERT INTO usuarios (username, hashed_pass, salt, email, nombre, apellidos, tipo) 
    VALUES (:username, :hashed_pass, :salt, :email, :nombre, :apellidos, :tipo)'
  );
  $stmt->execute([
    'username' => $usuario['username'],
    'hashed_pass' => $usuario['hashed_pass'],
    'salt' => $usuario['salt'],
    'email' => $usuario['email'],
    'nombre' => $usuario['nombre'],
    'apellidos' => $usuario['apellidos'],
    'tipo' => $usuario['tipo'],
  ]);
}

/**
 * Actualiza la contraseña y otros detalles de un usuario en la base de datos.
 *
 * @param array $usuario Los datos actualizados del usuario.
 * @param PDO   $conn    El objeto PDO que representa la conexión a la base de datos.
 */
function updateUsuarioPassword($usuario, $conn) {
  $stmt = $conn->prepare(
    'UPDATE usuarios 
     SET username = :username, hashed_pass = :hashed_pass, salt = :salt, nombre = :nombre, apellidos = :apellidos, email = :email, imagen = :imagen
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

/**
 * Actualiza la información de un usuario (sin actualizar la contraseña) en la base de datos.
 *
 * @param array $usuario Los datos actualizados del usuario.
 * @param PDO   $conn    El objeto PDO que representa la conexión a la base de datos.
 */
function updateUsuarioNoPassword($usuario, $conn) {
  $stmt = $conn->prepare(
    'UPDATE usuarios 
     SET username = :username, nombre = :nombre, apellidos = :apellidos, email = :email, imagen = :imagen
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

/**
 * Actualiza la información de un usuario administrador en la base de datos.
 *
 * @param array $usuario Los datos actualizados del usuario administrador.
 * @param PDO   $conn    El objeto PDO que representa la conexión a la base de datos.
 */
function updateUsuarioAdmin($usuario, $conn) {
  $stmt = $conn->prepare(
    'UPDATE usuarios 
     SET username = :username, nombre = :nombre, apellidos = :apellidos, email = :email
     WHERE id = :id'
  );

  $stmt->execute([
    'id' => $usuario['id'],
    'username' => $usuario['username'],
    'email' => $usuario['email'],
    'nombre' => $usuario['nombre'],
    'apellidos' => $usuario['apellidos'],
  ]);
}

/**
 * Obtiene la información de inicio de sesión de un usuario por su correo electrónico.
 *
 * @param string $email El correo electrónico del usuario.
 * @param PDO    $conn  El objeto PDO que representa la conexión a la base de datos.
 * @return mixed Un solo registro de la tabla de usuarios o false si no se encuentra el usuario.
 */
function getUsuarioLogin($email, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
  $stmt->execute(['email' => $email]);
  return $stmt->fetch();
}

/**
 * Obtiene el nombre de usuario por su ID.
 *
 * @param int $id   El ID del usuario.
 * @param PDO $conn El objeto PDO que representa la conexión a la base de datos.
 * @return mixed Un solo registro de la tabla de usuarios o false si no se encuentra el usuario.
 */
function getUsernameById($id, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}

/**
 * Obtiene todos los nombres de usuario y sus IDs.
 *
 * @param PDO $conn El objeto PDO que representa la conexión a la base de datos.
 * @return array Un arreglo de todos los nombres de usuario y sus IDs.
 */
function getAllUsernameAndId($conn) {
  $stmt = $conn->prepare('SELECT id, username FROM usuarios');
  $stmt->execute();
  return $stmt->fetchAll();
}

/**
 * Obtiene usuarios por tipo.
 *
 * @param string $tipo El tipo de usuario.
 * @param PDO    $conn El objeto PDO que representa la conexión a la base de datos.
 * @return array Un arreglo de usuarios del tipo especificado.
 */
function getUsuariosByTipo($tipo, $conn) {
  $stmt = $conn->prepare('SELECT * FROM usuarios WHERE tipo = :tipo');
  $stmt->execute(['tipo' => $tipo]);
  return $stmt->fetchAll();
}

/**
 * Elimina un usuario por su ID.
 *
 * @param int $id   El ID del usuario a eliminar.
 * @param PDO $conn El objeto PDO que representa la conexión a la base de datos.
 */
function deleteUsuariosById($id, $conn) {
  $stmt = $conn->prepare(
    'DELETE FROM usuarios 
        WHERE id = :id'
  );

  $stmt->execute([
    'id' => $id,
  ]);
}
?>
