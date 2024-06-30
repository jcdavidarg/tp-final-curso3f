<?php
session_start();

include_once '../modelo/Database.php';
include_once '../modelo/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Establece los datos en el objeto User
    $user->username = $username;

    // Buscar el usuario en la base de datos
    if ($user->login()) {
        // Verificar la contraseña ingresada con el hash almacenado
        if (password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->user_id;

            // Actualizar el status del usuario a 1
            $user->updateStatus(1);

            http_response_code(200);
            echo json_encode(array("message" => "Login successful."));
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Usuario y contraseña incorrectas';
            header("Location: ../vista/login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = 'Usuario no encontrado';
        header("Location: ../vista/login.php");
        exit();
    }
}
