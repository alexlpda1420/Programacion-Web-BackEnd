<?php
// 1) Conexion
require_once __DIR__ . '/conexion.php';

// 2) Almacenamos el ID recibido por GET
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("location:listar.php");
    exit;
}

// 3) Si se envio el formulario, procesamos la actualizacion antes de imprimir HTML
if (isset($_POST['guardar_cambios'])) {
    $prenda = mysqli_real_escape_string($conexion, $_POST['prenda']);
    $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
    $talle = mysqli_real_escape_string($conexion, $_POST['talle']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $link_compra = mysqli_real_escape_string($conexion, $_POST['link_compra'] ?? '');

    if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name'] != "") {
        $imagen_nueva = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    } else {
        $imagen_nueva = addslashes(base64_decode($_POST['imagen_actual']));
    }

    $consulta_actualizar = "UPDATE ropa SET prenda='$prenda', marca='$marca', talle='$talle', precio='$precio', imagen='$imagen_nueva', link_compra='$link_compra' WHERE id=$id";
    mysqli_query($conexion, $consulta_actualizar);

    header("location:listar.php");
    exit;
}

// 4) Buscamos los datos actuales de la prenda
$consulta = "SELECT * FROM ropa WHERE id=$id";
$respuesta = mysqli_query($conexion, $consulta);
$datos = mysqli_fetch_array($respuesta);

if (!$datos) {
    header("location:listar.php");
    exit;
}

$prenda = $datos["prenda"];
$marca = $datos["marca"];
$talle = $datos["talle"];
$precio = $datos["precio"];
$imagen = $datos['imagen'];
$link_compra = $datos['link_compra'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="tienda.css">
  <title>DeCompritas - Modificar prenda</title>
</head>
<body>
  <div class="page-wrapper">
    <header class="site-header">
      <nav class="navbar navbar-expand-lg navbar-light main-navbar">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img class="brand-logo" src="img/logo-decompritas.svg" alt="DeCompritas - Ropa y accesorios">
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav mb-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="bi bi-house-door nav-icon" aria-hidden="true"></i><span>Inicio</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#productos"><i class="bi bi-grid-3x3-gap nav-icon" aria-hidden="true"></i><span>Catalogo</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="listar.php"><i class="bi bi-card-list nav-icon" aria-hidden="true"></i><span>Listar</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="carrito.php"><i class="bi bi-cart3 nav-icon" aria-hidden="true"></i><span>Carrito</span><span class="cart-count cart-count-js" hidden></span></a>
              </li>
              <li class="nav-item">
                <a class="btn-admin text-decoration-none" href="agregar.html"><i class="bi bi-plus-circle nav-icon" aria-hidden="true"></i><span>Agregar</span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section class="page-hero">
      <div class="container">
        <span class="hero-kicker">Panel administrador</span>
        <h1>Modificar prenda</h1>
        <p>Actualiza los datos de la prenda seleccionada.</p>
      </div>
    </section>

    <main class="admin-section">
      <div class="container">
        <div class="admin-card">
          <div class="mb-4">
            <strong class="form-label d-block mb-2">Imagen actual</strong>
            <img class="current-image" src="data:image/jpg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen actual">
          </div>

          <form action="modificar.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="row g-4">
              <div class="col-md-6">
                <label class="form-label" for="prenda">Tipo de prenda</label>
                <input class="form-control" type="text" id="prenda" name="prenda" placeholder="Prenda" value="<?php echo htmlspecialchars($prenda); ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="marca">Marca</label>
                <input class="form-control" type="text" id="marca" name="marca" placeholder="Marca" value="<?php echo htmlspecialchars($marca); ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="talle">Talle</label>
                <input class="form-control" type="text" id="talle" name="talle" placeholder="Talle" value="<?php echo htmlspecialchars($talle); ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="precio">Precio</label>
                <input class="form-control" type="text" id="precio" name="precio" placeholder="Precio" value="<?php echo htmlspecialchars($precio); ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label" for="imagen">Imagen nueva</label>
                <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
                <small class="text-muted">Si no seleccionas una imagen nueva, se mantiene la actual.</small>
              </div>

              <div class="col-12">
                <label class="form-label" for="link_compra">Link de compra</label>
                <input class="form-control" type="url" id="link_compra" name="link_compra" placeholder="https://www.mercadopago.com.ar/..." value="<?php echo htmlspecialchars($link_compra); ?>">
                <small class="text-muted">Opcional. Puede ser un link de Mercado Pago, WhatsApp o una publicación externa.</small>
              </div>
            </div>

            <input type="hidden" name="imagen_actual" value="<?php echo base64_encode($imagen); ?>">

            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
              <button class="btn btn-pink" type="submit" name="guardar_cambios">Guardar cambios</button>
              <a class="btn btn-gray" href="listar.php">Cancelar</a>
            </div>
          </form>
        </div>
      </div>
    </main>

    <footer>
      <div class="container">
        <div class="row align-items-center gy-3">
          <div class="col-md-6">
            <h2 class="h5 mb-1">DeCompritas</h2>
            <p class="mb-0 text-white-50">Proyecto final de Programacion Web Backend.</p>
          </div>
          <div class="col-md-6 text-md-end">
            <a class="me-3" href="index.php">Inicio</a>
            <a class="me-3" href="listar.php">Listar</a>
            <a class="me-3" href="carrito.php">Carrito</a>
            <a href="agregar.html">Agregar</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="navbar-carrito.js"></script>
  <script src="ayuda-flotante.js"></script>
</body>
</html>
