<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estructuras de control: Parte 1</title>
</head>
<body>
    <h1>Tarea 3</h1>
    <h2>Alexis Roldan</h2>
    <h2>Punto 1</h2>
    <?php 
    $n = 2;
    if ($n > 0) {
        echo "La variable " . $n ." Es positivo";
    }
    ?>
    <h2>Punto 2</h2>
    <?php 
    $n = 2;
    if ($n > 1 && $n < 10)  {
        echo "La variable ". $n ." Esta entre 1 y 10";
    }
     ?>
     <h2>Punto 3</h2>
     <?php 
     $n = 25;
    if ($n > 10 || $n < 2) {
        echo "La variable ". $n ." Es mayor a 10 o menor a 2";
    }
      ?>
      <h2>Punto 4</h2>
      <?php 
      $n1 = 10;
      $n2 = 4;

      if ($n1 >  $n2) {
        echo "La suma de las variables es: " . $n1 + $n2 . " y la resta es: " . $n1 - $n2;
      }elseif ($n2 > $n1) {
        echo "La multiplicacion de las variables es: " . $n1 * $n2 . " la division es: " . $n1 / $n2 . " y el resto de la division es: " . $n1 % $n2;
      }
      else {
        echo "Los numeros ingresados son iguales";
      }

       ?>
</body>
</html>