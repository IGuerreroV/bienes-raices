<?php

use App\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

require '../../includes/app.php';
estaAutenticado();

$tipo = 'vendedores';

// Validar la URL por ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

//Obtener el arreglo del vendedor desde la BD
$vendedor = Vendedor::find($id);

// $vendedor = new Vendedor;

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

// Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los valores
    $args = $_POST['vendedor'];

    // Sincronizar objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);

    //validacion
    $errores = $vendedor->validar();

    // Obtener la carpeta de imagenes correspondiente
    $carpetaImagenes = getCarpetaImagenes($tipo);

    /* Subida de archivos */
    // Generar un nombre unico
    $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';

    if($_FILES['vendedor']['tmp_name']['imagen']) {
        $manager = new Image(Driver::class);
        $image = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
        $vendedor->setImagen($nombreImagen);
    }

    if(empty($errores)) {
        if($_FILES ['vendedor']['tmp_name']['imagen']) {
            $image->save($carpetaImagenes . $nombreImagen);
        }
        $vendedor->guardar();
    }

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

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input class="boton boton-verde" type="submit" value="Guardar Cambios">
    </form>
</main>

<?php
    incluirTemplate('footer')
?>