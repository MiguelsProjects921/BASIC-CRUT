<?php
require_once "Controlador/ControladorModelo.php"; 
$rutas = require "Vista/Rutas.php"; 

$ruta = $_GET['ruta'] ?? 'registro';

if (isset($rutas[$ruta])) {
    require_once $rutas[$ruta];
} else {
    header("Location: ./Vista/Error.php");
    exit;
}
?>
