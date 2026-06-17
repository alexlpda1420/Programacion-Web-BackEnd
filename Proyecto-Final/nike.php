<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>

<style>
  /* ==========================================
     CONFIGURACIÓN GENERAL & COLORES
     ========================================== */
  :root {
    --bg-color: #050505;       /* Negro absoluto de fondo */
    --surface-color: #121212;  /* Negro de las tarjetas */
    --primary-color: #fff200;  /* Amarillo fuerte */
    --accent-color: #39ff14;   /* Verde fluo / Neón */
    --text-color: #ffffff;     /* Blanco */
    --text-muted: #888888;     /* Gris para texto secundario */
  }

  body {
    background-color: var(--bg-color) !important;
    color: var(--text-color) !important;
    padding: 50px 20px;
  }

  /* ==========================================
     TÍTULOS Y DESCRIPCIÓN (Estructura Arriba)
     ========================================== */
  h1 {
    color: var(--primary-color) !important;
    font-size: 3rem !important;
    font-weight: 900 !important;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 5px !important;
  }

  h2 {
    color: var(--text-color) !important;
    font-size: 1.6rem !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px !important;
  }

  p {
    color: var(--text-muted) !important;
    font-size: 1rem !important;
    margin-bottom: 50px !important; /* Espacio generoso antes de los productos */
  }

  br {
    display: none; /* Eliminamos saltos de línea innecesarios */
  }

  /* ==========================================
     CONTENEDOR DE PRODUCTOS (Separación total)
     ========================================== */
  /* Forzamos a que la fila de Bootstrap use un espacio (gap) real estilo Mercado Libre */
  .row {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 30px !important; /* SEPARACIÓN EXACTA ENTRE CARDS */
    justify-content: center !important;
  }

  /* ==========================================
     TARJETAS DE PRODUCTO (Estilo Mercado Libre)
     ========================================== */
  .card {
    background-color: var(--surface-color) !important;
    border: 2px solid var(--accent-color) !important; /* MARCO VERDE FLUO */
    border-radius: 8px !important; /* Bordes ligeramente redondeados como ML */
    padding: 20px !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    text-align: center !important;

    /* Efecto de transición suave al pasar el mouse */
    transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    cursor: pointer;

    /* Forzamos el ancho restando el gap para que entren perfectamente */
    flex: 1 1 calc(25% - 30px) !important;
    min-width: 240px !important; /* Evita que se colapsen en pantallas chicas */
    max-width: 280px !important;
    height: 360px !important; /* Altura fija para que todas sean simétricas */
    box-shadow: none !important;
  }

  /* EFECTO HOVER (Se eleva y brilla al pasar el mouse) */
  .card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 12px 25px rgba(57, 255, 20, 0.3) !important; /* Brillo verde fluo */
  }

  /* ==========================================
     CONTENIDO INTERNO DE LAS CARDS
     ========================================== */

  /* Ajuste para las imágenes de los productos */
  .card-img-top {
    width: 100% !important;
    height: 180px !important; /* Forzamos una altura uniforme para la foto */
    object-fit: contain !important; /* Evita que la foto de la ropa se deforme */
    margin-bottom: 20px !important;
    background-color: rgba(255, 255, 255, 0.02) !important; /* Fondo sutil para la foto */
    border-radius: 4px;
    padding: 10px;
  }

  /* Marca del Producto (ADIDAS, NIKE, etc) */
  .card-title {
    color: var(--primary-color) !important; /* Texto Amarillo Fuerte */
    font-size: 1.3rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px;
    margin-top: auto !important; /* Empuja el texto hacia la parte baja de manera uniforme */
    margin-bottom: 8px !important;
  }

  /* Precio */
  .card span, .card h3 + span {
    color: var(--text-color) !important;
    font-size: 1.2rem !important;
    font-weight: 600 !important;
    display: block !important;
    margin-bottom: 10px !important;
  }
</style>

  <h1>Tienda de ropa</h1>
  <br>
  <h2>Lista de ropa</h2>
  <p>La siguiente lista muestra los productos de la marca NIKE.</p>
  <a href="index.php">HOME</a>
  <br>
  <a href="nikexl.php">NIKE XL</a>

  <section>
    <div class="container">
      <div class="row">

        <?php
        // 1) Conexion y selección de base de datos
        $conexion = mysqli_connect("127.0.0.1", "root", "");
        mysqli_select_db($conexion, "tienda"); // esto lo podemos poner acá o mas abajo, no hay problema

        // 2) Preparar la orden SQL

        $consulta='SELECT * FROM ropa WHERE marca="nike"';

        // 3) Ejecutar la orden y obtenemos los registros
        $datos= mysqli_query($conexion, $consulta);

        //  recorro todos los registros y genero una CARD PARA CADA UNA
        while ($reg = mysqli_fetch_array($datos)) {?>
          <div class="card col-sm-12 col-md-6 col-lg-3">
            <img class="card-img-top" src="data:image/jpg;base64, <?php echo base64_encode($reg['imagen'])?>" alt="" width="100px" height="100px")>

              <h3 class="card-title" style="width: 100%; font-size:25px;"><?php echo ucwords($reg['marca']) ?></h3>
              <span>$ <?php echo $reg['precio']; ?></span>

          </div>

        <?php } ?>

      </div>
    </div>
  </section>
  <button onclick="window.location.href='index.php'">Volver</button>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
