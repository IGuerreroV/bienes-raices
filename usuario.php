<?php

// Incluye el header
require 'includes/app.php';

// Importar la conexion
$db = conectarDB();

// Crear un email y password
$email = 'correo@correo.com';
$password = '123456';

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query para crear el usuasrio
$query = " INSERT INTO usuarios (email, password) VALUES ( '{$email}', '{$passwordHash}'); ";

// echo $query;


// Agregar a la base de datos
mysqli_query($db, $query);