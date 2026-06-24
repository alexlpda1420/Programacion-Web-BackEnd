<?php
session_start();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$accion = $_GET['accion'] ?? 'eliminar';

if ($id > 0 && isset($_SESSION['carrito'][$id])) {
    if ($accion === 'restar') {
        $_SESSION['carrito'][$id]--;

        if ($_SESSION['carrito'][$id] <= 0) {
            unset($_SESSION['carrito'][$id]);
        }
    } else {
        unset($_SESSION['carrito'][$id]);
    }
}

header("location:carrito.php");
exit;
?>
