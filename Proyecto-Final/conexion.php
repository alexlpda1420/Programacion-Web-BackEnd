<?php
// Conexion centralizada para usar el mismo proyecto en local y en hosting.
// En InfinityFree solo hay que completar la password del bloque "hosting".

$hostActual = $_SERVER['HTTP_HOST'] ?? '';
$esLocal = $hostActual === ''
    || strpos($hostActual, 'localhost') !== false
    || strpos($hostActual, '127.0.0.1') !== false;

$configLocal = [
    'host' => '127.0.0.1',
    'usuario' => 'root',
    'password' => '',
    'base' => 'tienda',
];

$configHosting = [
    'host' => 'sql111.infinityfree.com',
    'usuario' => 'if0_42263913',
    'password' => 'CAMBIAR_PASSWORD_INFINITYFREE',
    'base' => 'if0_42263913_tienda',
];

$config = $esLocal ? $configLocal : $configHosting;

$conexion = mysqli_connect($config['host'], $config['usuario'], $config['password']);

if (!$conexion) {
    die('No se pudo conectar con la base de datos.');
}

if (!mysqli_select_db($conexion, $config['base'])) {
    die('No se pudo seleccionar la base de datos.');
}

mysqli_set_charset($conexion, 'utf8mb4');
