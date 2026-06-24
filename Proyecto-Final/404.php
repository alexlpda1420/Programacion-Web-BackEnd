<?php
http_response_code(404);
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
  <title>DeCompritas - Pagina no encontrada</title>
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

    <main class="not-found-section">
      <div class="container">
        <section class="not-found-card">
          <span class="not-found-code">404</span>
          <span class="hero-kicker">Pagina no encontrada</span>
          <h1>Esta prenda no esta en nuestro catalogo</h1>
          <p>
            El enlace puede estar roto, la pagina pudo cambiar de lugar o quizas escribiste una direccion que no existe.
          </p>

          <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
            <a class="btn btn-pink" href="index.php">Volver al inicio</a>
            <a class="btn btn-gray" href="index.php#productos">Ver catalogo</a>
            <a class="btn btn-outline-secondary cart-empty-link" href="index.php#filtros">Buscar una prenda</a>
          </div>
        </section>
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
            <a class="me-3" href="quienes-somos.php">Quienes somos</a>
            <a href="carrito.php">Carrito</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="navbar-carrito.js"></script>
</body>
</html>
