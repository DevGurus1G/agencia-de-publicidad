<?php
/**
 * Establece una conexión a la base de datos MySQL.
 *
 * @param string $host     El nombre del host de la base de datos.
 * @param string $dbname   El nombre de la base de datos.
 * @param string $user     El nombre de usuario para la conexión.
 * @param string $password La contraseña para la conexión.
 * @return PDO|false Un objeto PDO que representa la conexión establecida o false en caso de error.
 */
function connect($host, $dbname, $user, $password) {
  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    return $conn;
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
}

/**
 * Cierra la conexión a la base de datos.
 *
 * @param PDO $conn El objeto PDO que representa la conexión a cerrar.
 */
function close($conn) {
  $conn = null;
}
?>
