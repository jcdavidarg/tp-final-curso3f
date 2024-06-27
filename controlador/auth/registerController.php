<?php
session_start();

include_once '../../Modelo/Database.php';
include_once '../../Modelo/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    // Recibe los datos del formulario de registro
    $user_email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar los campos obligatorios
    if (empty($user_email) || empty($username) || empty($password)) {
        $_SESSION['register_error'] = 'Todos los campos son obligatorios';
        header("Location: ../../vista/auth/register.php");
        exit();
    }

    // Hash de la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Establece los datos en el objeto User
    $user->username = $username;
    $user->password = $hashed_password;
    $user->user_email = $user_email;

    // Guardar el usuario en la base de datos
    if ($user->register()) {
        $_SESSION['register_success'] = 'Usuario creado correctamente';
        header("Location:../../vista/auth/register.php");
        exit();
    } else {
        $_SESSION['register_error'] = 'Error al crear el usuario';
        header("Location:../../vista/auth/register.php");
        exit();
    }
}
