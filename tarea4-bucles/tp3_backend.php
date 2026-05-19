<?php

// Trabajo Práctico N°3 - Backend - Bucles

echo"<h1> TP3 Backend - Ejercicios Bucles</h1>";

// Ejercicio 1: Imprimir los números del 1 al 100

echo "<h2>1. Números del 1 al 100</h2>";

for ($i = 1; $i <= 100; $i++) {
    echo $i . "<br>";
}

// Ejercicio 2: Imprimir los números del 100 al 1

echo "<h2>2. Números del 100 al 1</h2>";

for ($i = 100; $i >= 1; $i--) {
    echo $i . "<br>";
}

// Ejercicio 3: Imprimir los números pares del 1 al 100

echo "<h2>3. Números pares del 1 al 100</h2>";

for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 == 0) {
        echo $i . "<br>";
    }
}

// Ejercicio 4: Imprimir los números impares del 1 al 100
echo "<h2>4. Números impares del 1 al 100</h2>";

for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 != 0) {
        echo $i . "<br>";
    }
}

// Ejercicio 5: Imprimir la suma de los números de 1 a 20
echo "<h2>5. Suma de los números de 1 a 20</h2>";

$suma = 0;
for ($i = 1; $i <= 20; $i++) {
    $suma += $i;
}
echo "La suma es: " . $suma . "<br>";

// Ejercicio 6: Imprimir la suma de números pares de 1 a 20
echo "<h2>6. Suma de números pares de 1 a 20</h2>";

$suma_pares = 0;
for ($i = 2; $i <= 20; $i += 2) {
    $suma_pares += $i;
}
echo "La suma de los números pares es: " . $suma_pares . "<br>";

?>
