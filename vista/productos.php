<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:./login.php");
}

$current_page = basename($_SERVER['PHP_SELF']);

// URL de tu API
$api_url = 'http://localhost/tp-final-curso3f/vista/api/read.php';

// Obtener datos de la API
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Verificar si la respuesta contiene los productos
if (isset($data['items'])) {
    $productos = $data['items'];
} else {
    $productos = [];
}

//  CREAR PRODUCTO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre'])) {

        $nombre = $_POST['nombre'];
        $price = $_POST['price'];
        $descripcion = $_POST['descripcion'];
        $category = $_POST['category'];

        // Configuración de la API
        $api_url = 'http://localhost/tp-final-curso3f/vista/api/create.php';

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

    //  EDITAR PRODUCTO
    } elseif (isset($_POST['edit_id'])) {

        $id = $_POST['edit_id'];
        $nombre = $_POST['edit_nombre'];
        $price = $_POST['edit_price'];
        $descripcion = $_POST['edit_descripcion'];
        $category = $_POST['edit_category'];

        // Configuración de la API
        $api_url = 'http://localhost/tp-final-curso3f/vista/api/update.php';

        // Crear los datos del producto
        $data = [
            'id' => $id,
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
        if (isset($response_data['message']) && $response_data['message'] == 'Item was updated.') {
            $_SESSION['edit_success'] = "Producto editado con éxito.";
        } else {
            $_SESSION['edit_error'] = "Error al editar el producto.";
        }
    }
    // Redireccionar para evitar el reenvío del formulario
    header("Location: ./productos.php");
    exit;
}

//  ELIMINAR PRODCUTOS
if (isset($_GET['borrar'])) {
    $id = intval($_GET['borrar']); // Asegúrate de que el ID sea un entero

    print_r($id);

    // Configuración de la API
    $api_url = 'http://localhost/tp-final-curso3f/vista/api/delete.php';

    // Crear los datos del producto
    $data = [
        'id' => $id
    ];

    // Configuración de la solicitud cURL
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    // Ejecutar la solicitud cURL
    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);

    // Decodificar la respuesta JSON
    $response_data = json_decode($response, true);

    // Manejar la respuesta de la API
    if (isset($response_data['message']) && $response_data['message'] == 'Item was deleted.') {
        $_SESSION['delete_success'] = "Producto eliminado con éxito.";
    } else {
        $_SESSION['delete_error'] = "Error al eliminar el producto.";
        $_SESSION['delete_error_details'] = "Respuesta de la API: " . $response . " Error de cURL: " . $curl_error;
    }

    // Redireccionar para evitar el reenvío del formulario
    header("Location: ./productos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">
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
                        <a class="nav-link <?php echo ($current_page == 'productos.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="./productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="../controlador/logoutController.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>

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
                        <form action="./productos.php" method="post">
                            Nombre del producto: <input required class="form-control" type="text" name="nombre" id="">
                            <br />
                            Precio: <input required class="form-control" type="number" name="price" id="">
                            <br />
                            Número de categoría: <input required class="form-control" type="number" name="category" id="">
                            <br />
                            Descripción:
                            <textarea required class="form-control" type="text" name="descripcion" id="" rows="3"></textarea>
                            <br />
                            <input class="btn btn-success" type="submit" value="Enviar producto">
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
                                    <img width="150" src="../public/images/product_placeholder.png" class="img-fluid" alt="imagen de referencia de <?php echo $producto['name']; ?>">
                                </td>
                                <td class="align-middle"><?php echo $producto['description']; ?></td>
                                <td class="align-middle"><?php echo $producto['price']; ?></td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column flex-md-row">
                                        <button class="btn btn-warning btn-sm flex-fill mx-1 mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $producto['id']; ?>" data-name="<?php echo $producto['name']; ?>" data-price="<?php echo $producto['price']; ?>" data-description="<?php echo $producto['description']; ?>" data-category="<?php echo $producto['category_id']; ?>">Editar
                                        </button>
                                        <a class="btn btn-danger btn-sm flex-fill mx-1" href="?borrar=<?php echo $producto['id']; ?>">Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para editar producto -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Editar producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="./productos.php" method="post">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre del producto</label>
                                <input required type="text" class="form-control" name="edit_nombre" id="edit_nombre">
                            </div>
                            <div class="mb-3">
                                <label for="edit_price" class="form-label">Precio</label>
                                <input required type="number" class="form-control" name="edit_price" id="edit_price">
                            </div>
                            <div class="mb-3">
                                <label for="edit_category" class="form-label">Número de categoría</label>
                                <input required type="number" class="form-control" name="edit_category" id="edit_category">
                            </div>
                            <div class="mb-3">
                                <label for="edit_descripcion" class="form-label">Descripción</label>
                                <textarea required class="form-control" name="edit_descripcion" id="edit_descripcion" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var editModal = document.getElementById('editModal');
                editModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var name = button.getAttribute('data-name');
                    var price = button.getAttribute('data-price');
                    var description = button.getAttribute('data-description');
                    var category = button.getAttribute('data-category');

                    var modalTitle = editModal.querySelector('.modal-title');
                    var modalBodyInputId = editModal.querySelector('#edit_id');
                    var modalBodyInputName = editModal.querySelector('#edit_nombre');
                    var modalBodyInputPrice = editModal.querySelector('#edit_price');
                    var modalBodyInputDescription = editModal.querySelector('#edit_descripcion');
                    var modalBodyInputCategory = editModal.querySelector('#edit_category');

                    modalTitle.textContent = 'Editar producto ' + name;
                    modalBodyInputId.value = id;
                    modalBodyInputName.value = name;
                    modalBodyInputPrice.value = price;
                    modalBodyInputDescription.value = description;
                    modalBodyInputCategory.value = category;
                });
            });
        </script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>