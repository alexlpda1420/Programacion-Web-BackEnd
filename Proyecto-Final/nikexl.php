<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="tienda.css">
  <title>DeCompritas - Nike XL</title>
</head>
<body>
  <div class="page-wrapper">
    <header class="site-header">
      <div class="top-bar py-2">
        <div class="container d-flex justify-content-between align-items-center">
          <span>Proyecto Final Backend</span>
          <span><a href="login.html">Login</a> | <a href="login.html">Administradores</a></span>
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
                <a class="nav-link active" aria-current="page" href="nikexl.php">Nike XL</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#articulos">Articulos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#ofertas">Ofertas</a>
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
        <span class="hero-kicker">Filtro por talle</span>
        <h1>Nike XL</h1>
        <p>Productos de la marca Nike disponibles en talle XL.</p>
      </div>
    </section>

    <main class="products-section">
      <div class="container">
        <h2 class="section-title">Productos Nike XL</h2>
        <p class="section-description">La siguiente lista muestra los productos de la marca Nike en talle XL.</p>

        <div class="row g-4">
          <?php
          // 1) Conexion y seleccion de base de datos
          $conexion = mysqli_connect("127.0.0.1", "root", "");
          mysqli_select_db($conexion, "tienda");

          // 2) Preparar la orden SQL
          $consulta = 'SELECT * FROM ropa WHERE marca="nike" AND talle="xl"';

          // 3) Ejecutar la orden y obtenemos los registros
          $datos = mysqli_query($conexion, $consulta);

          // 4) Recorremos los registros y generamos una card para cada prenda
          while ($reg = mysqli_fetch_array($datos)) {
            $modalId = 'detalleNikeXl' . $reg['id'];
          ?>
            <div class="col-sm-12 col-md-6 col-lg-3 product-col">
              <article class="card product-card">
                <img class="card-img-top product-image" src="data:image/jpg;base64,<?php echo base64_encode($reg['imagen']); ?>" alt="Prenda <?php echo htmlspecialchars(ucwords($reg['marca'])); ?>">
                <div class="card-body d-flex flex-column">
                  <span class="badge product-badge align-self-center mb-3"><?php echo htmlspecialchars(strtoupper($reg['talle'])); ?></span>
                  <h3 class="card-title"><?php echo htmlspecialchars(ucwords($reg['marca'])); ?></h3>
                  <p class="card-text"><?php echo htmlspecialchars($reg['prenda']); ?></p>
                  <span class="product-price mt-auto">$ <?php echo htmlspecialchars($reg['precio']); ?></span>
                  <button class="btn btn-pink btn-sm product-detail-btn" type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                    Ver detalles
                  </button>
                </div>
              </article>

              <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title h5" id="<?php echo $modalId; ?>Label">Detalle del articulo</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                          <img class="modal-product-image" src="data:image/jpg;base64,<?php echo base64_encode($reg['imagen']); ?>" alt="Prenda <?php echo htmlspecialchars(ucwords($reg['marca'])); ?>">
                        </div>
                        <div class="col-md-6">
                          <dl class="detail-list">
                            <dt>ID</dt>
                            <dd><?php echo htmlspecialchars($reg['id']); ?></dd>
                            <dt>Tipo de prenda</dt>
                            <dd><?php echo htmlspecialchars($reg['prenda']); ?></dd>
                            <dt>Marca</dt>
                            <dd><?php echo htmlspecialchars(ucwords($reg['marca'])); ?></dd>
                            <dt>Talle</dt>
                            <dd><?php echo htmlspecialchars(strtoupper($reg['talle'])); ?></dd>
                            <dt>Precio</dt>
                            <dd>$ <?php echo htmlspecialchars($reg['precio']); ?></dd>
                          </dl>
                          <button class="btn btn-gray mt-2" type="button" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>

        <div class="text-center mt-5">
          <a class="btn btn-gray me-sm-2 mb-2 mb-sm-0" href="index.php">Volver al inicio</a>
          <a class="btn btn-pink" href="nike.php">Ver todo Nike</a>
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
            <a class="me-3" href="nike.php">Nike</a>
            <a href="login.html">Login</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
