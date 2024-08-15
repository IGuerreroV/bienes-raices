<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

// Validar la URL por ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

$vendedor = new Vendedor;

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

// Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
}

// Incluye un template
incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

    <a class="boton boton-verde" href="/admin">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin//vendedores/actualizar.php">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input class="boton boton-verde" type="submit" value="Guardar Cambios">
    </form>
</main>

<?php
    incluirTemplate('footer')
?>