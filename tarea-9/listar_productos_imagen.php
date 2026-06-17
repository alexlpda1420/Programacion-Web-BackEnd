<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Potrero Moda</title>
</head>

<body>

    <h1>Tienda de ropa</h1>

    <h2>Lista de ropa</h2>

    <p>
        La siguiente lista muestra los datos de la ropa actualmente en stock.
    </p>

    <br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>TIPO DE PRENDA</th>
            <th>MARCA</th>
            <th>TALLE</th>
            <th>PRECIO</th>
            <th>IMAGEN</th>
        </tr>

        <?php

        // 1) Conexión
        $conexion = mysqli_connect("127.0.0.1", "root", "");

        mysqli_select_db($conexion, "tienda");

        // 2) Preparar la consulta SQL
        $consulta = "SELECT * FROM ropa";

        // 3) Ejecutar la consulta
        $datos = mysqli_query($conexion, $consulta);

        // 4) Mostrar los datos
        while ($reg = mysqli_fetch_array($datos)) {

        ?>

            <tr>

                <td>
                    <?php echo $reg["id"]; ?>
                </td>

                <td>
                    <?php echo $reg["prenda"]; ?>
                </td>

                <td>
                    <?php echo $reg["marca"]; ?>
                </td>

                <td>
                    <?php echo $reg["talle"]; ?>
                </td>

                <td>
                    <?php echo $reg["precio"]; ?>
                </td>

                <td>
                    <img
                        src="data:image/png;base64,<?php echo base64_encode($reg["imagen"]); ?>"
                        alt="Imagen del producto"
                        width="100"
                        height="100">
                </td>

            </tr>

        <?php

        }

        ?>

    </table>

</body>

</html>