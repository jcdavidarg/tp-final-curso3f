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