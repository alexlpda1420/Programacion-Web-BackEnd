<?php
session_start();

function precioNumero($precio) {
    $normalizado = trim((string) $precio);
    $normalizado = str_replace(['$', ' '], '', $normalizado);

    if (strpos($normalizado, ',') !== false && strpos($normalizado, '.') !== false) {
        $normalizado = str_replace('.', '', $normalizado);
        $normalizado = str_replace(',', '.', $normalizado);
    } else {
        $normalizado = str_replace(',', '.', $normalizado);
    }

    return (float) $normalizado;
}

function precioFormato($precio) {
    return number_format($precio, 2, ',', '.');
}

$carrito = $_SESSION['carrito'] ?? [];
$productos = [];
$total = 0;
$cantidadTotal = 0;
$erroresCheckout = $_SESSION['checkout_errores'] ?? [];
$formCheckout = $_SESSION['checkout_form'] ?? [];

unset($_SESSION['checkout_errores']);
unset($_SESSION['checkout_form']);

if (!empty($carrito)) {
    $ids = implode(',', array_map('intval', array_keys($carrito)));

    $conexion = mysqli_connect("127.0.0.1", "root", "");
    mysqli_select_db($conexion, "tienda");

    $consulta = "SELECT * FROM ropa WHERE id IN ($ids)";
    $datos = mysqli_query($conexion, $consulta);

    while ($reg = mysqli_fetch_array($datos)) {
        $idProducto = (int) $reg['id'];
        $cantidad = (int) ($carrito[$idProducto] ?? 0);

        if ($cantidad <= 0) {
            continue;
        }

        $precioUnitario = precioNumero($reg['precio']);
        $subtotal = $precioUnitario * $cantidad;
        $linkCompra = trim($reg['link_compra'] ?? '');

        $reg['cantidad_carrito'] = $cantidad;
        $reg['subtotal_carrito'] = $subtotal;
        $reg['link_compra_valido'] = filter_var($linkCompra, FILTER_VALIDATE_URL);
        $productos[] = $reg;

        $total += $subtotal;
        $cantidadTotal += $cantidad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="tienda.css">
  <title>DeCompritas - Comprar carrito</title>
</head>
<body>
  <div class="page-wrapper">
    <header class="site-header">
      <div class="top-bar py-2">
        <div class="container d-flex justify-content-between align-items-center">
          <span>Proyecto Final Backend</span>
          <span><a href="carrito.php">Volver al carrito</a> | <a href="login.html">Administradores</a></span>
        </div>
      </div>

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
                <a class="nav-link" href="index.php">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="nike.php">Nike</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="nikexl.php">Nike XL</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="carrito.php">Carrito</a>
              </li>
              <li class="nav-item">
                <a class="btn-admin text-decoration-none" href="login.html">Admin</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section class="page-hero">
      <div class="container">
        <span class="hero-kicker">Resumen de compra</span>
        <h1>Comprar todo</h1>
        <p>Vista previa del pedido completo antes de conectar el pago unico con Mercado Pago.</p>
      </div>
    </section>

    <main class="cart-section">
      <div class="container">
        <?php if (empty($productos)) { ?>
          <div class="empty-cart text-center">
            <h2 class="section-title mb-3">No hay productos para comprar</h2>
            <p>Agrega productos al carrito para generar el resumen de compra.</p>
            <a class="btn btn-pink" href="index.php#productos">Ver productos</a>
          </div>
        <?php } else { ?>
          <div class="admin-card checkout-card">
            <div class="row g-4">
              <div class="col-lg-7">
                <h2 class="section-title text-lg-start mb-3">Pedido completo</h2>
                <p>
                  Este resumen deja listo el flujo del carrito. En la siguiente etapa se puede generar un link unico de Mercado Pago con todos los articulos.
                </p>

                <div class="checkout-list">
                  <?php foreach ($productos as $producto) { ?>
                    <article class="checkout-item">
                      <div>
                        <strong><?php echo htmlspecialchars($producto['prenda']); ?></strong>
                        <span><?php echo htmlspecialchars(ucwords($producto['marca'])); ?> - Talle <?php echo htmlspecialchars(strtoupper($producto['talle'])); ?></span>
                      </div>
                      <div class="text-md-end">
                        <span>Cantidad: <?php echo $producto['cantidad_carrito']; ?></span>
                        <strong>$ <?php echo precioFormato($producto['subtotal_carrito']); ?></strong>
                      </div>
                    </article>
                  <?php } ?>
                </div>
              </div>

              <div class="col-lg-5">
                <aside class="cart-summary m-0">
                  <h2>Total del pedido</h2>
                  <div class="cart-summary-row">
                    <span>Productos</span>
                    <strong><?php echo $cantidadTotal; ?></strong>
                  </div>
                  <div class="cart-summary-row cart-summary-total">
                    <span>Total</span>
                    <strong>$ <?php echo precioFormato($total); ?></strong>
                  </div>

                  <div class="d-grid gap-2 mt-4">
                    <a class="btn btn-gray" href="carrito.php">Volver al carrito</a>
                    <a class="btn btn-outline-secondary cart-empty-link" href="vaciar_carrito.php">Vaciar carrito</a>
                  </div>
                </aside>
              </div>
            </div>

            <hr class="my-4">

            <div class="checkout-form-box">
              <h3 class="h5 text-uppercase fw-bold mb-3">Datos para finalizar la compra</h3>

              <?php if (!empty($erroresCheckout)) { ?>
                <div class="alert alert-danger rounded-0" role="alert">
                  <strong>Revisa estos datos:</strong>
                  <ul class="mb-0 mt-2">
                    <?php foreach ($erroresCheckout as $error) { ?>
                      <li><?php echo htmlspecialchars($error); ?></li>
                    <?php } ?>
                  </ul>
                </div>
              <?php } ?>

              <form action="finalizar_compra.php" method="POST">
                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label" for="nombre">Nombre y apellido</label>
                    <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($formCheckout['nombre'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?php echo htmlspecialchars($formCheckout['email'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label" for="telefono">Telefono</label>
                    <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($formCheckout['telefono'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label" for="entrega">Forma de entrega</label>
                    <select class="form-control" id="entrega" name="entrega" required>
                      <option value="">Seleccione una opcion</option>
                      <option value="retiro" <?php echo (($formCheckout['entrega'] ?? '') === 'retiro') ? 'selected' : ''; ?>>Retiro por el local</option>
                      <option value="envio" <?php echo (($formCheckout['entrega'] ?? '') === 'envio') ? 'selected' : ''; ?>>Envio a domicilio</option>
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label" for="direccion">Direccion</label>
                    <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($formCheckout['direccion'] ?? ''); ?>" placeholder="Completar si seleccionas envio">
                  </div>

                  <div class="col-12">
                    <label class="form-label" for="comentarios">Comentarios</label>
                    <textarea class="form-control" id="comentarios" name="comentarios" rows="3" placeholder="Horarios, aclaraciones o referencias"><?php echo htmlspecialchars($formCheckout['comentarios'] ?? ''); ?></textarea>
                  </div>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                  <button class="btn btn-pink" type="submit">Confirmar pedido</button>
                  <a class="btn btn-gray" href="carrito.php">Volver al carrito</a>
                </div>
              </form>
            </div>

            <hr class="my-4">

            <h3 class="h5 text-uppercase fw-bold mb-3">Links individuales disponibles</h3>
            <div class="d-flex flex-wrap gap-2">
              <?php foreach ($productos as $producto) { ?>
                <?php if ($producto['link_compra_valido']) { ?>
                  <a class="btn btn-pink btn-sm" href="<?php echo htmlspecialchars($producto['link_compra']); ?>" target="_blank" rel="noopener noreferrer">
                    Comprar <?php echo htmlspecialchars($producto['prenda']); ?>
                  </a>
                <?php } else { ?>
                  <span class="btn btn-gray btn-sm disabled" aria-disabled="true">
                    Sin link: <?php echo htmlspecialchars($producto['prenda']); ?>
                  </span>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
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
            <a class="me-3" href="carrito.php">Carrito</a>
            <a href="login.html">Login</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
