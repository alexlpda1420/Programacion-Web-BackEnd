<?php

// Trabajo Práctico 4 - Backend

echo"<h1> TP4 Backend - Arrays</h1>";

// 1. Almacenar en un array los 10 primeros números pares y mostrarlos uno debajo del otro
echo "<h2>1. Los 10 primeros números pares</h2>";

$numerosPares = array(2, 4, 6, 8, 10, 12, 14, 16, 18, 20);

for ($i = 0; $i < count($numerosPares); $i++) {
    echo $numerosPares[$i] . "<br>";
}

// 2. Crear un array con Pedro, Ana, 34 y 1 sin asignar índice
echo "<h2>2. Array con valores variados usando print_r()</h2>";

$datos = array("Pedro", "Ana", 34, 1);

echo "<pre>";
print_r($datos);
echo "</pre>";

// 3. Crear un array asociativo con datos personales
echo "<h2>3. Array asociativo</h2>";

$persona = array(
    "Nombre" => "Pedro",
    "Apellido" => "Torres",
    "Direccion" => "Av. Mayor 3703",
    "Telefono" => "1122334455"
);

echo "<pre>";
print_r($persona);
echo "</pre>";

// 4. Crear un array con ciudades sin asignar índices y mostrar su contenido
echo "<h2>4. Array de ciudades sin índices personalizados</h2>";

$ciudades = array("Madrid", "Barcelona", "Londres", "New York", "Los Ángeles", "Chicago");

for ($i = 0; $i < count($ciudades); $i++) {
    echo "La ciudad con el índice " . $i . " tiene el nombre " . $ciudades[$i] . ".<br>";
}

// 5. Crear un array de ciudades con índices personalizados
echo "<h2>5. Array de ciudades con índices personalizados</h2>";

$ciudadesConIndice = array(
    "MD" => "Madrid",
    "BCL" => "Barcelona",
    "LD" => "Londres",
    "NY" => "New York",
    "LA" => "Los Ángeles",
    "CCG" => "Chicago"
);

foreach ($ciudadesConIndice as $indice => $ciudad) {
    echo "El índice de " . $ciudad . " es " . $indice . ".<br>";
}

?>

