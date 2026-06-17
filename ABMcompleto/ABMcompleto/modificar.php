<?php
// 1) Conexion
$conexion = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($conexion, "tienda");

// 2) Almacenamos los datos del envío GET
$id = $_GET['id'];

// 3) Preparar la SQL
$consulta = "SELECT * FROM ropa WHERE id=$id";

// 4) Ejecutar la orden y almacenamos en una variable el resultado
$respuesta = mysqli_query($conexion, $consulta);

// 5) Transformamos el registro obtenido a un array
$datos = mysqli_fetch_array($respuesta);

// 6) Asignamos a diferentes variables los respectivos valores del array $datos
$prenda = $datos["prenda"];
$marca = $datos["marca"];
$talle = $datos["talle"];
$precio = $datos["precio"];
$imagen = $datos['imagen'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Ropa - Modificar Prenda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>Modificar</h2>
    <p>Ingrese los nuevos datos de la prenda.</p>
    <div>
        <strong>Imagen actual:</strong><br>
        <img src="data:image/png;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen actual" width="100px" height="100px">
    </div>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Tipo de prenda</label>
        <input type="text" name="prenda" placeholder="Prenda" value="<?php echo $prenda; ?>" required><br>
        <label>Marca</label>
        <input type="text" name="marca" placeholder="Marca" value="<?php echo $marca; ?>" required><br>
        <label>Talle</label>
        <input type="text" name="talle" placeholder="Talle" value="<?php echo $talle; ?>" required><br>
        <label>Precio</label>
        <input type="text" name="precio" placeholder="Precio" value="<?php echo $precio; ?>" required><br>
        <label>Imagen (si no selecciona, se mantiene la actual)</label>
        <input type="file" name="imagen" accept="image/*"><br>
        <!-- Campo oculto para mantener la imagen actual si no se sube una nueva -->
        <input type="hidden" name="imagen_actual" value="<?php echo base64_encode($imagen); ?>">
        <br>
        <input type="submit" name="guardar_cambios" value="Guardar Cambios">
        <button type="submit" name="Cancelar" formaction="index.html">Cancelar</button>
    </form>

<?php
// 7) Si se envió el formulario, procesamos la actualización (este bloque queda al final)
if (array_key_exists('guardar_cambios', $_POST)) {
    $prenda = $_POST['prenda'];
    $marca = $_POST['marca'];
    $talle = $_POST['talle'];
    $precio = $_POST['precio'];

    // Si el usuario subió una nueva imagen, la usamos; si no, mantenemos la anterior
    if ($_FILES['imagen']['tmp_name'] != "") {
        $imagen_nueva = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    } else {
        // Usamos la imagen actual del campo oculto si no se subió una nueva
        $imagen_nueva = addslashes(base64_decode($_POST['imagen_actual']));
    }

    // Actualizamos la base de datos
    $consulta_actualizar = "UPDATE ropa SET prenda='$prenda', marca='$marca', talle='$talle', precio='$precio', imagen='$imagen_nueva' WHERE id=$id";
    mysqli_query($conexion, $consulta_actualizar);

    // Redirigimos a la lista de prendas usando JavaScript
    echo '<script>window.location.href = "listar.php";</script>';
    exit;
}
?>
</body>
</html>
