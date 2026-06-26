<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="tienda.css">
  <title>DeCompritas - Administracion</title>
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
        <h1>Lista de ropa</h1>
        <p>La siguiente tabla muestra los datos de la ropa actualmente cargada en stock.</p>
      </div>
    </section>

    <main class="admin-section">
      <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
          <div>
            <h2 class="section-title text-md-start mb-2">Prendas cargadas</h2>
            <p class="mb-0">Desde aca podes editar o borrar registros.</p>
          </div>
          <a class="btn btn-pink" href="agregar.html">Agregar ropa</a>
        </div>

        <div class="admin-card">
          <div class="table-responsive">
            <table class="table table-admin table-hover align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tipo de prenda</th>
                  <th>Marca</th>
                  <th>Talle</th>
                  <th>Precio</th>
                  <th>Imagen</th>
                  <th>Compra</th>
                  <th>Editar</th>
                  <th>Borrar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // 1) Conexion
                require_once __DIR__ . '/conexion.php';

                // 2) Preparar la orden SQL
                $consulta = 'SELECT * FROM ropa';

                // 3) Ejecutar la orden y obtenemos los registros
                $datos = mysqli_query($conexion, $consulta);

                // 4) Mostrar los datos del registro
                while ($reg = mysqli_fetch_array($datos)) { ?>
                  <tr>
                    <td><?php echo $reg['id']; ?></td>
                    <td><?php echo htmlspecialchars($reg['prenda']); ?></td>
                    <td><?php echo htmlspecialchars($reg['marca']); ?></td>
                    <td><?php echo htmlspecialchars($reg['talle']); ?></td>
                    <td>$ <?php echo htmlspecialchars($reg['precio']); ?></td>
                    <td>
                      <img class="table-image" src="data:image/jpg;base64,<?php echo base64_encode($reg['imagen']); ?>" alt="Prenda <?php echo htmlspecialchars($reg['marca']); ?>">
                    </td>
                    <td>
                      <?php
                      $linkCompra = trim($reg['link_compra'] ?? '');
                      if (filter_var($linkCompra, FILTER_VALIDATE_URL)) { ?>
                        <a class="btn btn-sm btn-pink" href="<?php echo htmlspecialchars($linkCompra); ?>" target="_blank" rel="noopener noreferrer">Abrir</a>
                      <?php } else { ?>
                        <span class="text-muted">Sin link</span>
                      <?php } ?>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-gray" href="modificar.php?id=<?php echo $reg['id']; ?>">Editar</a>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-pink" href="borrar.php?id=<?php echo $reg['id']; ?>">Borrar</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
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
            <a class="me-3" href="agregar.html">Agregar</a>
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
