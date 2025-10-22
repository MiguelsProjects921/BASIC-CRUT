<?php
function obtenerConexion() {
    $host     = "localhost";
    $nombrebd = "Productos_DB";
    $usuario  = "root";
    $password = "";

    $conexion = new mysqli($host, $usuario, $password, $nombrebd);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    return $conexion;
}
?>
