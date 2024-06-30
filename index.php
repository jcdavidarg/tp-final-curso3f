<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:./vista/login.php");
}

$current_page = basename($_SERVER['PHP_SELF']);

// URL de tu API
$api_url = 'http://localhost/tp-final-curso3f/vista/api/read.php'; // Reemplaza con la URL de tu API

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
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<body>
    <div class="container">

        <div class="row my-4">
            <div class="col-md">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="./index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'productos.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="./vista/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="./controlador/logoutController.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header text-bg-muted p-2"></div>
                    <div class="card-body">
                        <h3 class="display-3">Bienvenidos</h3>
                        <p class="lead">Este es un CRUD con Login y Register</p>
                        <hr class="my-2">
                        <p>Este es el proyecto final para el curso de la municipalidad de tres de febrero</p>
                    </div>
                    <div class="card-footer text-bg-muted p-2"></div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 my-2">
            <?php if (!empty($productos)) : ?>
                <?php foreach ($productos as $producto) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="image-container">
                                <img src="./public/images/product_placeholder.png" class="card-img-top" alt="imagen de referencia de <?php echo $producto['name']; ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $producto['name']; ?></h5>
                                <p class="card-text"><?php echo $producto['description']; ?></p>
                            </div>
                            <div class="card-footer bg-success text-white">
                                <small class="lead">$<?php echo $producto['price']; ?> USD</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>