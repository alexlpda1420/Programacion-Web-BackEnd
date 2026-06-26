<?php
session_start();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("location:index.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

$consulta = "SELECT id FROM ropa WHERE id=$id LIMIT 1";
$respuesta = mysqli_query($conexion, $consulta);

if ($respuesta && mysqli_num_rows($respuesta) > 0) {
    if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = 0;
    }

    $_SESSION['carrito'][$id]++;
}

header("location:carrito.php");
exit;
?>
