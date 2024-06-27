<?php
session_start();
if(!isset($_SESSION["user_id"])) {
    header("location:./vista/auth/login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <a href="./index.php">Inicio | </a>
        <a href="./vista/auth/register.php">Registrar Usuario | </a>
        <a href="./controlador/auth/logoutController.php">Cerrar Sesion</a>
