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



  <h1>Tienda de ropa</h1>
  <br>
  <h2>Lista de ropa</h2>
  <p>La siguiente lista muestra los datos de la ropa actualmente en stock.</p>
<a href="index.php">HOME</a>
  <a href="nike.php">NIKE</a>
  <section>
    <div class="container">
      <div class="row">

        <?php
        // 1) Conexion y selección de base de datos
        $conexion = mysqli_connect("127.0.0.1", "root", "");
        mysqli_select_db($conexion, "tienda"); // esto lo podemos poner acá o mas abajo, no hay problema

        // 2) Preparar la orden SQL

        $consulta='SELECT * FROM ropa';

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
  <a href="login.html">Administradores</a>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
