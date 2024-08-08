<?php

    $resultado = $_GET['resultado'] ?? null;

    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if(intval( $resultado ) === 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php endif; ?>

        <a class="boton boton-verde" href="/admin/propiedades/crear.php">Nueva Propiedad</a>
    </main>

<?php
    incluirTemplate('footer')
?>