<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Precios mayores a 500</title>
</head>
<body>

<h1>Prendas con precio mayor a 500</h1>

<?php

// Conexión con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "tienda");

// Comprobamos si la conexión funcionó
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL
$sql = "SELECT * FROM ropa WHERE precio > 500";

// Ejecutamos la consulta
$resultado = mysqli_query($conexion, $sql);

?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Prenda</th>
        <th>Marca</th>
        <th>Talle</th>
        <th>Precio</th>
    </tr>

    <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>

        <tr>
            <td><?php echo $fila["id"]; ?></td>
            <td><?php echo $fila["prenda"]; ?></td>
            <td><?php echo $fila["marca"]; ?></td>
            <td><?php echo $fila["talle"]; ?></td>
            <td><?php echo $fila["precio"]; ?></td>
        </tr>

    <?php } ?>

</table>

<?php

mysqli_close($conexion);

?>

</body>
</html>