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

        $reg['cantidad_carrito'] = $cantidad;
        $reg['subtotal_carrito'] = $subtotal;
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="tienda.css?v=carrito-miniaturas">
  <title>DeCompritas - Carrito</title>
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
                <a class="nav-link" href="index.php#filtros"><i class="bi bi-search nav-icon" aria-hidden="true"></i><span>Buscar</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="quienes-somos.php"><i class="bi bi-people nav-icon" aria-hidden="true"></i><span>Nosotros</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="carrito.php"><i class="bi bi-cart3 nav-icon" aria-hidden="true"></i><span>Carrito</span><span class="cart-count cart-count-js" hidden></span></a>
              </li>
              <li class="nav-item">
                <a class="btn-admin text-decoration-none" href="login.html"><i class="bi bi-person-lock nav-icon" aria-hidden="true"></i><span>Admin</span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section class="page-hero">
      <div class="container">
        <span class="hero-kicker">Compra online</span>
        <h1>Carrito</h1>
        <p>Productos seleccionados durante la navegacion por el catalogo.</p>
      </div>
    </section>

    <main class="cart-section">
      <div class="container">
        <?php if (empty($productos)) { ?>
          <div class="empty-cart text-center">
            <h2 class="section-title mb-3">Tu carrito esta vacio</h2>
            <p>Agrega productos desde el catalogo para verlos aca.</p>
            <a class="btn btn-pink" href="index.php#productos">Ver productos</a>
          </div>
        <?php } else { ?>
          <div class="row g-4 align-items-start">
            <div class="col-lg-8">
              <div class="cart-list">
                <?php foreach ($productos as $producto) { ?>
                  <article class="cart-item">
                    <div class="cart-thumb">
                      <img class="cart-image" width="88" height="88" style="width: 88px; height: 88px; max-width: 88px; max-height: 88px; object-fit: contain;" src="data:image/jpg;base64,<?php echo base64_encode($producto['imagen']); ?>" alt="Prenda <?php echo htmlspecialchars(ucwords($producto['marca'])); ?>">
                    </div>

                    <div class="cart-info">
                      <span class="badge product-badge mb-2"><?php echo htmlspecialchars(strtoupper($producto['talle'])); ?></span>
                      <h2 class="cart-product-title"><?php echo htmlspecialchars(ucwords($producto['marca'])); ?></h2>
                      <p class="mb-1"><?php echo htmlspecialchars($producto['prenda']); ?></p>
                      <strong>$ <?php echo precioFormato(precioNumero($producto['precio'])); ?></strong>
                    </div>

                    <div class="cart-quantity">
                      <span class="cart-label">Cantidad</span>
                      <div class="quantity-controls">
                        <a href="quitar_carrito.php?id=<?php echo $producto['id']; ?>&accion=restar" aria-label="Restar unidad">-</a>
                        <span><?php echo $producto['cantidad_carrito']; ?></span>
                        <a href="agregar_carrito.php?id=<?php echo $producto['id']; ?>" aria-label="Sumar unidad">+</a>
                      </div>
                    </div>

                    <div class="cart-price-box">
                      <span class="cart-label">Subtotal</span>
                      <strong class="cart-subtotal">$ <?php echo precioFormato($producto['subtotal_carrito']); ?></strong>
                      <a class="btn btn-sm btn-gray mt-3" href="quitar_carrito.php?id=<?php echo $producto['id']; ?>">Quitar</a>
                    </div>
                  </article>
                <?php } ?>
              </div>
            </div>

            <div class="col-lg-4">
              <aside class="cart-summary">
                <h2>Resumen</h2>
                <div class="cart-summary-row">
                  <span>Productos</span>
                  <strong><?php echo $cantidadTotal; ?></strong>
                </div>
                <div class="cart-summary-row cart-summary-total">
                  <span>Total</span>
                  <strong>$ <?php echo precioFormato($total); ?></strong>
                </div>

                <div class="d-grid gap-2 mt-4">
                  <a class="btn btn-pink" href="comprar_carrito.php">Comprar todo</a>
                  <a class="btn btn-gray" href="index.php#productos">Seguir comprando</a>
                  <a class="btn btn-outline-secondary cart-empty-link" href="vaciar_carrito.php">Vaciar carrito</a>
                </div>
              </aside>
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
            <a class="me-3" href="index.php#productos">Catalogo</a>
            <a href="login.html">Login</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="navbar-carrito.js"></script>
</body>
</html>
