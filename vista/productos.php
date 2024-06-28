<?php include("./header.php"); ?>

<?php

$current_page = basename($_SERVER['PHP_SELF']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $price = $_POST['price'];
    $descripcion = $_POST['descripcion'];
    $category = $_POST['category'];
    
    // Configuración de la API
    $api_url = 'http://localhost/tp-final-curso3f/vista/productos/create.php'; // Reemplaza con la URL de tu API

    // Crear los datos del producto
    $data = [
        'name' => $nombre,
        'price' => $price,
        'description' => $descripcion,
        'category_id' => $category
    ];

    // Configuración de la solicitud cURL
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    // Ejecutar la solicitud cURL
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificar la respuesta JSON
    $response_data = json_decode($response, true);

    // Manejar la respuesta de la API
    if (isset($response_data['message']) && $response_data['message'] == 'Item was created.') {
        $_SESSION['create_success'] = "Producto creado con éxito.";
    } else {
        $_SESSION['create_error'] = "Error al crear el producto.";
    }

    // Redireccionar para evitar el reenvío del formulario
    header("Location: ../../tp-final-curso3f/vista/productos.php");
    exit;
}

// URL de tu API para obtener productos
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

<div class="row my-4">
    <div class="col-md">
        <div class="card">
            <div class="card-header bg-success text-white lead">
                Crear producto
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['create_error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['create_error'] . '</div>';
                    unset($_SESSION['create_error']);
                }
                if (isset($_SESSION['create_success'])) {
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['create_success'] . '</div>';
                    unset($_SESSION['create_success']);
                }
                ?>
                <form action="../../tp-final-curso3f/vista/productos.php" method="post">
                    <!-- REQUIRED PARA QUE ENVIAR VACIO -->
                    Nombre del producto: <input required class="form-control" type="text" name="nombre" id="">
                    <br />
                    precio: <input required class="form-control" type="number" name="price" id="">
                    <br />
                    Numero de categoria: <input required class="form-control" type="number" name="category" id="">
                    <br />
                    Descripción:
                    <textarea required class="form-control" type="text" name="descripcion" id="" rows="3"></textarea>
                    <br />
                    <!-- Imagen del producto: <input required class="form-control" type="file" name="archivo" id="">
                    <br /> -->
                    <input class="btn btn-success" type="submit" value="Enviar proyecto">

                </form>
            </div>
        </div>
    </div>
</div>


<div class="row my-4">
    <div class="col-md">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td class="align-middle"><?php echo $producto['id']; ?></td>
                        <td class="align-middle"><?php echo $producto['name']; ?></td>
                        <td class="align-middle">
                            <!-- <img width="150" src="./imagenes/<?php echo $producto['imagen']; ?>" class="img-fluid" alt="imagen de referencia de <?php echo $producto['nombre']; ?>"> -->
                            <img width="150" src="../../tp-final-curso3f/public/images/product_placeholder.png" class="img-fluid" alt="imagen de referencia de <?php echo $producto['nombre']; ?>">
                        </td>
                        <td class="align-middle"><?php echo $producto['description']; ?></td>
                        <td class="align-middle"><?php echo $producto['price']; ?></td>
                        <!-- MANDO POR LA URL UNA QUERY - PARAMETRO LLAMADO borrar con el id del registro -->
                        <td class="align-middle">
                            <div class="d-flex flex-column flex-md-row">
                                <a class="btn btn-warning btn-sm flex-fill mx-1 mb-1 mb-md-0" href="?editar=<?php echo $producto['id']; ?>">Editar</a>
                                <a class="btn btn-danger btn-sm flex-fill mx-1" href="?borrar=<?php echo $producto['id']; ?>">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<?php include("./footer.php"); ?>