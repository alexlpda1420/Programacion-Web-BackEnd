<?php
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
    return number_format(precioNumero($precio), 2, ',', '.');
}

function imagenProducto($producto) {
    return 'data:image/jpg;base64,' . base64_encode($producto['imagen']);
}

require_once __DIR__ . '/conexion.php';

$buscar = trim($_GET['buscar'] ?? '');
$marcaFiltro = trim($_GET['marca'] ?? '');
$talleFiltro = trim($_GET['talle'] ?? '');
$precioMin = trim($_GET['precio_min'] ?? '');
$precioMax = trim($_GET['precio_max'] ?? '');
$orden = $_GET['orden'] ?? 'recientes';
$filtrosActivos = $buscar !== '' || $marcaFiltro !== '' || $talleFiltro !== '' || $precioMin !== '' || $precioMax !== '';

$marcas = [];
$consultaMarcas = mysqli_query($conexion, "SELECT DISTINCT marca FROM ropa WHERE marca <> '' ORDER BY marca ASC");
while ($fila = mysqli_fetch_assoc($consultaMarcas)) {
    $marcas[] = $fila['marca'];
}

$talles = [];
$consultaTalles = mysqli_query($conexion, "SELECT DISTINCT talle FROM ropa WHERE talle <> '' ORDER BY talle ASC");
while ($fila = mysqli_fetch_assoc($consultaTalles)) {
    $talles[] = $fila['talle'];
}

$novedades = [];
$consultaNovedades = mysqli_query($conexion, "SELECT * FROM ropa ORDER BY id DESC LIMIT 3");
while ($fila = mysqli_fetch_array($consultaNovedades)) {
    $novedades[] = $fila;
}

$destacados = [];
$consultaDestacados = mysqli_query($conexion, "SELECT * FROM ropa ORDER BY precio+0 ASC, id DESC LIMIT 3");
while ($fila = mysqli_fetch_array($consultaDestacados)) {
    $destacados[] = $fila;
}

$heroProductos = [];
$consultaHero = mysqli_query($conexion, "SELECT * FROM ropa ORDER BY id DESC LIMIT 4");
while ($fila = mysqli_fetch_array($consultaHero)) {
    $heroProductos[] = $fila;
}

$condiciones = [];

if ($buscar !== '') {
    $buscarSql = mysqli_real_escape_string($conexion, $buscar);
    $condiciones[] = "(prenda LIKE '%$buscarSql%' OR marca LIKE '%$buscarSql%' OR talle LIKE '%$buscarSql%')";
}

if ($marcaFiltro !== '') {
    $marcaSql = mysqli_real_escape_string($conexion, $marcaFiltro);
    $condiciones[] = "marca = '$marcaSql'";
}

if ($talleFiltro !== '') {
    $talleSql = mysqli_real_escape_string($conexion, $talleFiltro);
    $condiciones[] = "talle = '$talleSql'";
}

if ($precioMin !== '' && is_numeric(str_replace(',', '.', $precioMin))) {
    $condiciones[] = "precio+0 >= " . (float) str_replace(',', '.', $precioMin);
}

if ($precioMax !== '' && is_numeric(str_replace(',', '.', $precioMax))) {
    $condiciones[] = "precio+0 <= " . (float) str_replace(',', '.', $precioMax);
}

$ordenSql = "id DESC";

if ($orden === 'precio_asc') {
    $ordenSql = "precio+0 ASC";
} elseif ($orden === 'precio_desc') {
    $ordenSql = "precio+0 DESC";
} elseif ($orden === 'marca') {
    $ordenSql = "marca ASC, prenda ASC";
}

$consultaProductos = "SELECT * FROM ropa";

if (!empty($condiciones)) {
    $consultaProductos .= " WHERE " . implode(" AND ", $condiciones);
}

$consultaProductos .= " ORDER BY $ordenSql";
$datos = mysqli_query($conexion, $consultaProductos);
$totalResultados = $datos ? mysqli_num_rows($datos) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="tienda.css?v=hero-watermark">
  <title>DeCompritas - Inicio</title>
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
                <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house-door nav-icon" aria-hidden="true"></i><span>Inicio</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#productos"><i class="bi bi-grid-3x3-gap nav-icon" aria-hidden="true"></i><span>Catalogo</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#filtros"><i class="bi bi-search nav-icon" aria-hidden="true"></i><span>Buscar</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#articulos"><i class="bi bi-newspaper nav-icon" aria-hidden="true"></i><span>Novedades</span></a>
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

    <section class="hero hero-home">
      <?php if (!empty($heroProductos)) { ?>
        <div class="hero-watermark" aria-hidden="true">
          <?php foreach ($heroProductos as $producto) { ?>
            <img src="<?php echo imagenProducto($producto); ?>" alt="">
          <?php } ?>
        </div>
      <?php } ?>

      <div class="container">
        <div class="hero-content">
          <img class="hero-logo" src="img/logo-decompritas.svg" alt="DeCompritas - Ropa y accesorios">
          <span class="hero-kicker">Catalogo online</span>
          <h1>Grandes tallas bajos precios</h1>
          <p>
            Explora prendas cargadas desde la base de datos, filtra por marca o talle y arma tu carrito de compra.
          </p>
          <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
            <a class="btn btn-pink" href="#productos">Ver catalogo</a>
            <a class="btn btn-outline-light rounded-0 px-4 text-uppercase fw-bold" href="#filtros">Buscar prenda</a>
          </div>
        </div>
      </div>
    </section>

    <section id="articulos" class="new-products">
      <div class="container">
        <h2 class="section-title">Articulos nuevos</h2>
        <p class="section-description">Ultimas prendas cargadas en el catalogo.</p>

        <div class="row g-4">
          <?php if (!empty($novedades)) { ?>
            <?php foreach ($novedades as $producto) { ?>
              <div class="col-md-4">
                <article class="feature-card">
                  <img class="feature-image" src="<?php echo imagenProducto($producto); ?>" alt="<?php echo htmlspecialchars($producto['prenda']); ?>">
                  <div class="card-body">
                    <span class="badge product-badge mb-2"><?php echo htmlspecialchars(strtoupper($producto['talle'])); ?></span>
                    <h3><?php echo htmlspecialchars(ucwords($producto['marca'])); ?></h3>
                    <p><?php echo htmlspecialchars($producto['prenda']); ?> - $ <?php echo precioFormato($producto['precio']); ?></p>
                    <a class="btn btn-pink btn-sm" href="agregar_carrito.php?id=<?php echo $producto['id']; ?>">Agregar al carrito</a>
                  </div>
                </article>
              </div>
            <?php } ?>
          <?php } else { ?>
            <div class="col-12">
              <div class="empty-cart text-center">
                <h3 class="section-title mb-3">Sin articulos cargados</h3>
                <p>Cuando agregues prendas desde el panel, apareceran en esta seccion.</p>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <section id="ofertas" class="carousel-section">
      <div class="container">
        <h2 class="section-title">Mejores precios</h2>
        <p class="section-description">Seleccion generada automaticamente con los productos de menor precio.</p>

        <div id="carouselTienda" class="carousel slide carousel-shell" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <?php if (!empty($destacados)) { ?>
              <?php foreach ($destacados as $indice => $producto) { ?>
                <button type="button" data-bs-target="#carouselTienda" data-bs-slide-to="<?php echo $indice; ?>" class="<?php echo $indice === 0 ? 'active' : ''; ?>" aria-current="<?php echo $indice === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $indice + 1; ?>"></button>
              <?php } ?>
            <?php } else { ?>
              <button type="button" data-bs-target="#carouselTienda" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <?php } ?>
          </div>

          <div class="carousel-inner">
            <?php if (!empty($destacados)) { ?>
              <?php foreach ($destacados as $indice => $producto) { ?>
                <div class="carousel-item <?php echo $indice === 0 ? 'active' : ''; ?>">
                  <div class="carousel-content offer-slide">
                    <div class="offer-image-wrap">
                      <img class="offer-image" src="<?php echo imagenProducto($producto); ?>" alt="<?php echo htmlspecialchars($producto['prenda']); ?>">
                    </div>
                    <div class="offer-copy">
                      <span class="hero-kicker">Precio destacado</span>
                      <h2><?php echo htmlspecialchars(ucwords($producto['marca'])); ?></h2>
                      <p><?php echo htmlspecialchars($producto['prenda']); ?> en talle <?php echo htmlspecialchars(strtoupper($producto['talle'])); ?></p>
                      <strong>$ <?php echo precioFormato($producto['precio']); ?></strong>
                      <a class="btn btn-pink btn-sm mt-3" href="agregar_carrito.php?id=<?php echo $producto['id']; ?>">Agregar al carrito</a>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php } else { ?>
              <div class="carousel-item active">
                <div class="carousel-content">
                  <h2>Catalogo en preparacion</h2>
                  <p>Carga productos para generar ofertas y destacados automaticamente.</p>
                </div>
              </div>
            <?php } ?>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselTienda" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselTienda" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </button>
        </div>
      </div>
    </section>

    <section id="filtros" class="filters-section">
      <div class="container">
        <h2 class="section-title">Buscar en el catalogo</h2>
        <form class="filter-card" method="GET" action="index.php#productos">
          <div class="row g-3">
            <div class="col-lg-4">
              <label class="form-label" for="buscar">Buscar prenda</label>
              <input class="form-control" type="text" id="buscar" name="buscar" placeholder="Buzo, remera, adidas..." value="<?php echo htmlspecialchars($buscar); ?>">
            </div>

            <div class="col-md-6 col-lg-2">
              <label class="form-label" for="marca">Marca</label>
              <select class="form-control" id="marca" name="marca">
                <option value="">Todas</option>
                <?php foreach ($marcas as $marca) { ?>
                  <option value="<?php echo htmlspecialchars($marca); ?>" <?php echo $marcaFiltro === $marca ? 'selected' : ''; ?>><?php echo htmlspecialchars(ucwords($marca)); ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-6 col-lg-2">
              <label class="form-label" for="talle">Talle</label>
              <select class="form-control" id="talle" name="talle">
                <option value="">Todos</option>
                <?php foreach ($talles as $talle) { ?>
                  <option value="<?php echo htmlspecialchars($talle); ?>" <?php echo $talleFiltro === $talle ? 'selected' : ''; ?>><?php echo htmlspecialchars(strtoupper($talle)); ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-6 col-lg-2">
              <label class="form-label" for="precio_min">Precio minimo</label>
              <input class="form-control" type="number" id="precio_min" name="precio_min" min="0" step="1" value="<?php echo htmlspecialchars($precioMin); ?>">
            </div>

            <div class="col-md-6 col-lg-2">
              <label class="form-label" for="precio_max">Precio maximo</label>
              <input class="form-control" type="number" id="precio_max" name="precio_max" min="0" step="1" value="<?php echo htmlspecialchars($precioMax); ?>">
            </div>

            <div class="col-lg-4">
              <label class="form-label" for="orden">Ordenar por</label>
              <select class="form-control" id="orden" name="orden">
                <option value="recientes" <?php echo $orden === 'recientes' ? 'selected' : ''; ?>>Mas recientes</option>
                <option value="precio_asc" <?php echo $orden === 'precio_asc' ? 'selected' : ''; ?>>Menor precio</option>
                <option value="precio_desc" <?php echo $orden === 'precio_desc' ? 'selected' : ''; ?>>Mayor precio</option>
                <option value="marca" <?php echo $orden === 'marca' ? 'selected' : ''; ?>>Marca A-Z</option>
              </select>
            </div>

            <div class="col-lg-8 d-flex flex-column flex-sm-row gap-2 align-items-sm-end">
              <button class="btn btn-pink" type="submit">Aplicar filtros</button>
              <a class="btn btn-gray" href="index.php#productos">Limpiar filtros</a>
            </div>
          </div>
        </form>
      </div>
    </section>

    <main id="productos" class="products-section">
      <div class="container">
        <h2 class="section-title">Productos disponibles</h2>
        <p class="section-description">
          <?php if ($filtrosActivos) { ?>
            Se encontraron <?php echo $totalResultados; ?> producto(s) con los filtros aplicados.
          <?php } else { ?>
            La siguiente lista muestra la ropa actualmente en stock.
          <?php } ?>
        </p>

        <?php if ($totalResultados === 0) { ?>
          <div class="empty-cart text-center">
            <h3 class="section-title mb-3">No encontramos productos</h3>
            <p>Proba con otra busqueda, cambia el talle o limpia los filtros.</p>
            <a class="btn btn-pink" href="index.php#productos">Limpiar filtros</a>
          </div>
        <?php } else { ?>
          <div class="row g-4">
            <?php
            while ($reg = mysqli_fetch_array($datos)) {
              $modalId = 'detalleProducto' . $reg['id'];
              $linkCompra = trim($reg['link_compra'] ?? '');
              $linkCompraValido = filter_var($linkCompra, FILTER_VALIDATE_URL);
            ?>
              <div class="col-sm-12 col-md-6 col-lg-3 product-col">
                <article class="card product-card">
                  <img class="card-img-top product-image" src="<?php echo imagenProducto($reg); ?>" alt="Prenda <?php echo htmlspecialchars(ucwords($reg['marca'])); ?>">
                  <div class="card-body d-flex flex-column">
                    <span class="badge product-badge align-self-center mb-3"><?php echo htmlspecialchars(strtoupper($reg['talle'])); ?></span>
                    <h3 class="card-title"><?php echo htmlspecialchars(ucwords($reg['marca'])); ?></h3>
                    <p class="card-text"><?php echo htmlspecialchars($reg['prenda']); ?></p>
                    <span class="product-price mt-auto">$ <?php echo precioFormato($reg['precio']); ?></span>
                    <div class="product-actions">
                      <a class="btn btn-gray btn-sm" href="agregar_carrito.php?id=<?php echo $reg['id']; ?>">
                        Agregar al carrito
                      </a>
                      <?php if ($linkCompraValido) { ?>
                        <a class="btn btn-pink btn-sm" href="<?php echo htmlspecialchars($linkCompra); ?>" target="_blank" rel="noopener noreferrer">
                          Comprar ahora
                        </a>
                      <?php } ?>
                      <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                        Ver detalles
                      </button>
                    </div>
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
                            <img class="modal-product-image" src="<?php echo imagenProducto($reg); ?>" alt="Prenda <?php echo htmlspecialchars(ucwords($reg['marca'])); ?>">
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
                              <dd>$ <?php echo precioFormato($reg['precio']); ?></dd>
                              <dt>Link de compra</dt>
                              <dd>
                                <?php if ($linkCompraValido) { ?>
                                  <a class="btn btn-pink btn-sm" href="<?php echo htmlspecialchars($linkCompra); ?>" target="_blank" rel="noopener noreferrer">Comprar ahora</a>
                                <?php } else { ?>
                                  <span class="text-muted">Este producto no tiene link de compra cargado.</span>
                                <?php } ?>
                              </dd>
                            </dl>
                            <div class="d-flex flex-column flex-sm-row gap-2 mt-2">
                              <a class="btn btn-pink" href="agregar_carrito.php?id=<?php echo $reg['id']; ?>">Agregar al carrito</a>
                              <button class="btn btn-gray" type="button" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
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
            <a class="me-3" href="quienes-somos.php">Quienes somos</a>
            <a class="me-3" href="carrito.php">Carrito</a>
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
