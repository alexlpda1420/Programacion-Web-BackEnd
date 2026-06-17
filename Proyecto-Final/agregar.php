<?php
// 1) Conexion
$conexion = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($conexion, "tienda");

// 2) Almacenamos los datos enviados por POST
$prenda = mysqli_real_escape_string($conexion, $_POST['prenda']);
$marca = mysqli_real_escape_string($conexion, $_POST['marca']);
$talle = mysqli_real_escape_string($conexion, $_POST['talle']);
$precio = mysqli_real_escape_string($conexion, $_POST['precio']);
$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

// 3) Preparar la orden SQL
$consulta = "INSERT INTO ropa (id, prenda, marca, talle, precio, imagen)
             VALUES ('', '$prenda', '$marca', '$talle', '$precio', '$imagen')";

// 4) Ejecutar la consulta y redirigir al listado
mysqli_query($conexion, $consulta);

header("location:listar.php");
exit;
?>
