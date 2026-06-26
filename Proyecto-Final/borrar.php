<?php
// 1) Conexion
require_once __DIR__ . '/conexion.php';

// 2) Almacenamos el ID recibido por GET
$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

// 3) Eliminamos el registro solo si el ID es valido
if ($id > 0) {
    $consulta = "DELETE FROM ropa WHERE id=$id";
    mysqli_query($conexion, $consulta);
}

// 4) Redirigir al listado
header("location:listar.php");
exit;
?>
