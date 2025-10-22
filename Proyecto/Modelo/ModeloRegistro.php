<?php
require_once __DIR__ . "/../BD/Conexion.php";

function insertar($nombre, $categoria, $precio, $stock, $fechaIngreso) {
    $conexion = obtenerConexion();

    $stmt = $conexion->prepare("SELECT ID FROM Productos WHERE Nombre = ? LIMIT 1");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conexion->close();
        return "duplicado";
    }
    $stmt->close();

    $stmt = $conexion->prepare(
        "INSERT INTO Productos (Nombre, Categoria, Precio, Stock, FechaIngreso) 
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssdis", $nombre, $categoria, $precio, $stock, $fechaIngreso);
    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();
    return $resultado;
}

function eliminar($id) {
    $conexion = obtenerConexion();

    $stmt = $conexion->prepare("DELETE FROM Productos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();
    return $resultado;
}

function listar() {
    $conexion  = obtenerConexion();
    $resultado = mysqli_query($conexion, "SELECT * FROM Productos");

    $productos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }

    $conexion->close();
    return $productos;
}

function listarId($id) {
    $conexion = obtenerConexion();

    $stmt = $conexion->prepare("SELECT * FROM Productos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $producto  = $resultado->fetch_assoc();

    $stmt->close();
    $conexion->close();
    return $producto ?: null;
}

function actualizar($nombre, $categoria, $precio, $stock, $fechaIngreso, $id) {
    $conexion = obtenerConexion();

    $stmt = $conexion->prepare("SELECT ID FROM Productos WHERE Nombre = ? AND ID != ?");
    $stmt->bind_param("si", $nombre, $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conexion->close();
        return "duplicado";
    }
    $stmt->close();

    $stmt = $conexion->prepare(
        "UPDATE Productos 
         SET Nombre = ?, Categoria = ?, Precio = ?, Stock = ?, FechaIngreso = ?
         WHERE ID = ?"
    );
    $stmt->bind_param("ssdisi", $nombre, $categoria, $precio, $stock, $fechaIngreso, $id);
    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();
    return $resultado;
}
?>
