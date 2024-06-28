<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:./vista/auth/login.php");
}

$current_page = basename($_SERVER['PHP_SELF']);

// URL de tu API
$api_url = 'http://localhost/tp-final-curso3f/vista/productos/read.php'; // Reemplaza con la URL de tu API

// Obtener datos de la API
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Verificar si la respuesta contiene los productos
if (isset($data['items'])) {
    $productos = $data['items'];
} else {
    $productos = [];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../tp-final-curso3f/public/css/style.css">
</head>

<body>
    <div class="container">

        <div class="row my-4">
            <div class="col-md">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="../../tp-final-curso3f/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'productos.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="../../tp-final-curso3f/vista/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="../../tp-final-curso3f/controlador/auth/logoutController.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>