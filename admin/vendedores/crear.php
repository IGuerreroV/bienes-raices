<?php

require '../../includes/app.php';
use App\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

estaAutenticado();

$vendedor = new Vendedor;

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

// Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crea una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);
    $tipo = 'vendedores';

    // Obtener la carpeta de imagenes correspondiente
    $carpetaImagenes = getCarpetaImagenes($tipo);

    /* SUBIDA DE IMAGEN */
    // Generar nombre unico
    $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

    // Setear imagen
    // Realiza un resize a la imagen con intervention
    if($_FILES['vendedor']['tmp_name']['imagen']) {
        $manager = new Image(Driver::class);
        $image = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
        $vendedor->setImagen($nombreImagen);
    }

    // Validar que no haya campos vacios
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)) {
        // Crea carpeta para subir imagenes
        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Guarda la imagen en el servidor
        $image->save($carpetaImagenes . $nombreImagen);

        // Guardar en la base de datos
        $vendedor->guardar();
    }
}

// Incluye un template
incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>

    <a class="boton boton-verde" href="/admin">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin//vendedores/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input class="boton boton-verde" type="submit" value="Registrar Vendedor(a)">
    </form>
</main>

<?php
    incluirTemplate('footer')
?>