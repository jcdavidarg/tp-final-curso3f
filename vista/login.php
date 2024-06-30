<?php

session_start();

if (isset($_SESSION["user_id"])) {
    header("location:../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Ingreso</title>
</head>

<body>

    <div class="container">

        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <div class="row my-4">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'login.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="./login.php">Ingreso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'register.php') ? 'active bg-success text-white' : 'text-success'; ?>" href="./register.php">Registrar</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Iniciar Sesión</div>
                    <div class="card-body">
                        <!-- Mostrar mensaje de error -->
                        <?php
                        if (isset($_SESSION['login_error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['login_error'] . '</div>';
                            unset($_SESSION['login_error']); // Eliminar el mensaje después de mostrarlo
                        }
                        ?>
                        <!-- FORMULARIO -->
                        <form action="../controlador/loginController.php" method="post">
                            Usuario: <input class="form-control" type="text" name="username" id="">
                            <br />
                            Contraseña: <input class="form-control" type="password" name="password" id="">
                            <br />
                            <button class="btn btn-success" type="submit">Ingresar</button>
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