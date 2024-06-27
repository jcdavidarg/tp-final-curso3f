<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Registrar</title>
</head>

<body>
    
    <div class="container">

        <?php include("./navbar.php") ?>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <!-- Mostrar mensaje de error al crear -->
                        <?php
                        if (isset($_SESSION['register_error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['register_error'] . '</div>';
                            unset($_SESSION['register_error']); // Eliminar el mensaje después de mostrarlo
                        }
                        if (isset($_SESSION['register_success'])) {
                            echo '<div class="alert alert-success" role="alert">' . $_SESSION['register_success'] . '</div>';
                            unset($_SESSION['register_success']); // Eliminar el mensaje después de mostrarlo
                        }
                        ?>
                        <!-- FORMULARIO -->
                        <form action="../../Controlador/auth/registerController.php" method="post">
                            Email: <input class="form-control" type="email" name="email" id="">
                            <br />
                            Usuario: <input class="form-control" type="text" name="username" id="">
                            <br />
                            Contraseña: <input class="form-control" type="password" name="password" id="">
                            <br />
                            <button class="btn btn-success" type="submit">Registrar Usuario</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>