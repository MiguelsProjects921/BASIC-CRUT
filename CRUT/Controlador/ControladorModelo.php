<?php
require_once __DIR__ . "/../Modelo/ModeloRegistro.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['ruta']) && $_GET['ruta'] === 'insertar') {
    $nombre       = $_POST["nombre"];
    $categoria    = $_POST["categoria"];
    $precio       = $_POST["precio"];
    $stock        = $_POST["stock"];
    $fechaIngreso = $_POST["fechaIngreso"];

    $resultado = insertar($nombre, $categoria, $precio, $stock, $fechaIngreso);

    if ($resultado === "duplicado") {
        echo json_encode(["status" => "error", "message" => "El producto ya está registrado"]);
    } elseif ($resultado) {
        echo json_encode(["status" => "success", "message" => "Producto registrado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el producto"]);
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['ruta']) && $_GET['ruta'] === 'eliminar' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $resultado = eliminar($id);

    if ($resultado) {
        echo json_encode(["status" => "success", "message" => "El producto fue eliminado exitosamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al eliminar el producto."]);
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['ruta']) && $_GET['ruta'] === 'actualizar') {
    $id           = $_POST['idactualizar'];
    $nombre       = $_POST['nombre'];
    $categoria    = $_POST['categoria'];
    $precio       = $_POST['precio'];
    $stock        = $_POST['stock'];
    $fechaIngreso = $_POST['fechaIngreso'];

    $resultado = actualizar($nombre, $categoria, $precio, $stock, $fechaIngreso, $id);

    if ($resultado === "duplicado") {
        echo json_encode(["status" => "error", "message" => "Ya existe otro producto con ese nombre"]);
    } elseif ($resultado) {
        echo json_encode(["status" => "success", "message" => "El producto fue actualizado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar el producto"]);
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['ruta']) && $_GET['ruta'] === 'listar') {
    $productos = listar();
    echo json_encode($productos);
    exit;
}

$productos = listar();

$Aproducto = null;
if (isset($_GET['idactualizar'])) {
    $Aproducto = listarId($_GET['idactualizar']);
}
