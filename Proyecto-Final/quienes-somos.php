<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="tienda.css">
  <title>DeCompritas - Quienes somos</title>
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
                <a class="nav-link active" aria-current="page" href="quienes-somos.php"><i class="bi bi-people nav-icon" aria-hidden="true"></i><span>Nosotros</span></a>
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

    <section class="about-hero">
      <div class="container">
        <span class="hero-kicker">Quienes somos</span>
        <h1>Ropa y accesorios pensados para comprar facil</h1>
        <p>
          DeCompritas nace como un proyecto de Programacion Web Backend y crece con una idea simple: mostrar productos de forma clara, permitir buscar rapido y armar un carrito sin vueltas.
        </p>
        <a class="btn btn-pink" href="index.php">Volver a la pagina principal</a>
      </div>
    </section>

    <main class="about-section">
      <div class="container">
        <div class="row g-4 align-items-stretch">
          <div class="col-lg-7">
            <article class="about-card h-100">
              <span class="hero-kicker">Nuestra tienda</span>
              <h2>Un catalogo online simple, ordenado y responsive</h2>
              <p>
                El sitio esta desarrollado para presentar prendas cargadas desde una base de datos, con imagenes, precios, filtros, carrito de compras y una experiencia visual consistente.
              </p>
              <p>
                La propuesta combina una estetica limpia con funcionalidades propias de un ecommerce inicial: busqueda por producto, filtros por marca y talle, compra rapida por link externo y flujo de checkout educativo.
              </p>
            </article>
          </div>

          <div class="col-lg-5">
            <aside class="about-card about-highlight h-100">
              <img class="about-logo" src="img/logo-decompritas.svg" alt="DeCompritas - Ropa y accesorios">
              <p>
                Proyecto final realizado para integrar HTML, CSS, Bootstrap, PHP, MySQL y sesiones.
              </p>
            </aside>
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-4">
            <article class="about-value">
              <i class="bi bi-search-heart" aria-hidden="true"></i>
              <h3>Busqueda clara</h3>
              <p>Filtros para encontrar prendas por texto, marca, talle y precio.</p>
            </article>
          </div>

          <div class="col-md-4">
            <article class="about-value">
              <i class="bi bi-cart-check" aria-hidden="true"></i>
              <h3>Compra simple</h3>
              <p>Carrito con cantidades, resumen del pedido y confirmacion final.</p>
            </article>
          </div>

          <div class="col-md-4">
            <article class="about-value">
              <i class="bi bi-phone" aria-hidden="true"></i>
              <h3>Responsive</h3>
              <p>Una interfaz preparada para escritorio, tablet y celular.</p>
            </article>
          </div>
        </div>

        <div class="text-center mt-5">
          <a class="btn btn-pink me-sm-2 mb-2 mb-sm-0" href="index.php">Volver al inicio</a>
          <a class="btn btn-gray" href="index.php#productos">Ver catalogo</a>
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
            <a class="me-3" href="index.php#productos">Catalogo</a>
            <a href="carrito.php">Carrito</a>
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
