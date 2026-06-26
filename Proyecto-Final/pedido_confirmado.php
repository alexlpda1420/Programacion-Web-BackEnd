<?php
session_start();

function precioFormato($precio) {
    return number_format($precio, 2, ',', '.');
}

$pedido = $_SESSION['ultimo_pedido'] ?? null;
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
  <title>DeCompritas - Pedido confirmado</title>
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
                <a class="nav-link" href="carrito.php"><i class="bi bi-cart3 nav-icon" aria-hidden="true"></i><span>Carrito</span><span class="cart-count cart-count-js" hidden></span></a>
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
        <span class="hero-kicker">Pedido recibido</span>
        <h1>Compra confirmada</h1>
        <p>El carrito fue procesado correctamente.</p>
      </div>
    </section>

    <main class="cart-section">
      <div class="container">
        <?php if (!$pedido) { ?>
          <div class="empty-cart text-center">
            <h2 class="section-title mb-3">No hay un pedido reciente</h2>
            <p>Cuando finalices una compra, el resumen aparecera en esta pantalla.</p>
            <a class="btn btn-pink" href="index.php#productos">Ver productos</a>
          </div>
        <?php } else { ?>
          <div class="admin-card confirmation-card">
            <div class="confirmation-header">
              <div>
                <span class="hero-kicker">Pedido #<?php echo htmlspecialchars($pedido['numero']); ?></span>
                <h2>Gracias, <?php echo htmlspecialchars($pedido['cliente']['nombre']); ?></h2>
                <p>Fecha: <?php echo htmlspecialchars($pedido['fecha']); ?></p>
              </div>
              <strong class="confirmation-total">$ <?php echo precioFormato($pedido['total']); ?></strong>
            </div>

            <div class="row g-4 mt-2">
              <div class="col-lg-7">
                <h3 class="h5 text-uppercase fw-bold mb-3">Productos comprados</h3>
                <div class="checkout-list">
                  <?php foreach ($pedido['productos'] as $producto) { ?>
                    <article class="checkout-item">
                      <div>
                        <strong><?php echo htmlspecialchars($producto['prenda']); ?></strong>
                        <span><?php echo htmlspecialchars(ucwords($producto['marca'])); ?> - Talle <?php echo htmlspecialchars(strtoupper($producto['talle'])); ?></span>
                      </div>
                      <div class="text-md-end">
                        <span>Cantidad: <?php echo $producto['cantidad']; ?></span>
                        <strong>$ <?php echo precioFormato($producto['subtotal']); ?></strong>
                      </div>
                    </article>
                  <?php } ?>
                </div>
              </div>

              <div class="col-lg-5">
                <aside class="cart-summary m-0">
                  <h2>Datos de contacto</h2>
                  <div class="cart-summary-row">
                    <span>Email</span>
                    <strong><?php echo htmlspecialchars($pedido['cliente']['email']); ?></strong>
                  </div>
                  <div class="cart-summary-row">
                    <span>Telefono</span>
                    <strong><?php echo htmlspecialchars($pedido['cliente']['telefono']); ?></strong>
                  </div>
                  <div class="cart-summary-row">
                    <span>Entrega</span>
                    <strong><?php echo $pedido['cliente']['entrega'] === 'envio' ? 'Envio' : 'Retiro'; ?></strong>
                  </div>
                  <?php if ($pedido['cliente']['direccion'] !== '') { ?>
                    <div class="cart-summary-row">
                      <span>Direccion</span>
                      <strong><?php echo htmlspecialchars($pedido['cliente']['direccion']); ?></strong>
                    </div>
                  <?php } ?>
                  <?php if ($pedido['cliente']['comentarios'] !== '') { ?>
                    <div class="cart-summary-row">
                      <span>Comentarios</span>
                      <strong><?php echo htmlspecialchars($pedido['cliente']['comentarios']); ?></strong>
                    </div>
                  <?php } ?>
                  <div class="cart-summary-row cart-summary-total">
                    <span>Total</span>
                    <strong>$ <?php echo precioFormato($pedido['total']); ?></strong>
                  </div>
                </aside>
              </div>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
              <a class="btn btn-pink" href="index.php#productos">Seguir comprando</a>
              <a class="btn btn-gray" href="carrito.php">Ver carrito</a>
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
  <script src="navbar-carrito.js"></script>
  <script src="ayuda-flotante.js"></script>
</body>
</html>
