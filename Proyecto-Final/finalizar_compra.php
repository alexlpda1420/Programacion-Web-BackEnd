<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');

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

function obtenerProductosCarrito($carrito) {
    $productos = [];
    $total = 0;
    $cantidadTotal = 0;

    if (empty($carrito)) {
        return [$productos, $total, $cantidadTotal];
    }

    $ids = implode(',', array_map('intval', array_keys($carrito)));

    require_once __DIR__ . '/conexion.php';

    $consulta = "SELECT * FROM ropa WHERE id IN ($ids)";
    $datos = mysqli_query($conexion, $consulta);

    while ($reg = mysqli_fetch_array($datos)) {
        $idProducto = (int) $reg['id'];
        $cantidad = (int) ($carrito[$idProducto] ?? 0);

        if ($cantidad <= 0) {
            continue;
        }

        $precioUnitario = precioNumero($reg['precio']);
        $subtotal = $precioUnitario * $cantidad;

        $productos[] = [
            'id' => $idProducto,
            'prenda' => $reg['prenda'],
            'marca' => $reg['marca'],
            'talle' => $reg['talle'],
            'precio' => $precioUnitario,
            'cantidad' => $cantidad,
            'subtotal' => $subtotal
        ];

        $total += $subtotal;
        $cantidadTotal += $cantidad;
    }

    return [$productos, $total, $cantidadTotal];
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location:comprar_carrito.php");
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$entrega = trim($_POST['entrega'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$comentarios = trim($_POST['comentarios'] ?? '');
$errores = [];

if ($nombre === '') {
    $errores[] = 'Ingrese su nombre y apellido.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'Ingrese un email valido.';
}

if ($telefono === '') {
    $errores[] = 'Ingrese un telefono de contacto.';
}

if (!in_array($entrega, ['retiro', 'envio'], true)) {
    $errores[] = 'Seleccione una forma de entrega.';
}

if ($entrega === 'envio' && $direccion === '') {
    $errores[] = 'Ingrese una direccion para coordinar el envio.';
}

[$productos, $total, $cantidadTotal] = obtenerProductosCarrito($_SESSION['carrito'] ?? []);

if (empty($productos)) {
    $errores[] = 'El carrito esta vacio.';
}

if (!empty($errores)) {
    $_SESSION['checkout_errores'] = $errores;
    $_SESSION['checkout_form'] = [
        'nombre' => $nombre,
        'email' => $email,
        'telefono' => $telefono,
        'entrega' => $entrega,
        'direccion' => $direccion,
        'comentarios' => $comentarios
    ];

    header("location:comprar_carrito.php");
    exit;
}

$_SESSION['ultimo_pedido'] = [
    'numero' => date('YmdHis'),
    'fecha' => date('d/m/Y H:i'),
    'cliente' => [
        'nombre' => $nombre,
        'email' => $email,
        'telefono' => $telefono,
        'entrega' => $entrega,
        'direccion' => $direccion,
        'comentarios' => $comentarios
    ],
    'productos' => $productos,
    'total' => $total,
    'cantidad_total' => $cantidadTotal
];

unset($_SESSION['carrito']);
unset($_SESSION['checkout_form']);
unset($_SESSION['checkout_errores']);

header("location:pedido_confirmado.php");
exit;
?>
