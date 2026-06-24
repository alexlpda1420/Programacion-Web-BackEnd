<?php
session_start();

$cantidad = 0;

if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    $cantidad = array_sum($_SESSION['carrito']);
}

header('Content-Type: application/json');
echo json_encode(['cantidad' => $cantidad]);
?>
