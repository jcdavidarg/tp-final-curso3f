<?php
session_start();

include_once '../../Modelo/Database.php';
include_once '../../Modelo/User.php';

// Verifica si el usuario está logueado
if (isset($_SESSION['user_id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->user_id = $_SESSION['user_id'];

    // Actualiza el estado del usuario a 0
    $user->updateStatus(0);
}

// Destruir la sesión
session_unset();
session_destroy();

// Redirigir al login
header("Location: ../../vista/auth/login.php");
exit();
