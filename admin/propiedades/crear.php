<?php

    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    estaAutenticado();

    $propiedad = new Propiedad;

    // Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // debuguear($errores);

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        /* Crea una nueva Instancia */
        $propiedad = new Propiedad($_POST['propiedad']);
        $tipo = 'propiedades';

        // Obtener la carpeta de imagenes correspondiente
        $carpetaImagenes = getCarpetaImagenes($tipo);

        /* SUBIDA DE ARCHIVOS */
        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        // Setear la imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);
            $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validar();

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        
        // debuguear($carpetaImagenes . $nombreImagen);

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el array de errores este vacio
        if(empty($errores)) {

            // Crear la carpeta para subir imagenes
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Guarda la imagen en el servidor
            $image->save($carpetaImagenes . $nombreImagen);

            // Guarda en la base de datos
            $propiedad->guardar();
        }
    }

    // Incluye un template
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a class="boton boton-verde" href="/admin">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin//propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input class="boton boton-verde" type="submit" value="Crear Propiedad">
        </form>
    </main>

<?php
    incluirTemplate('footer')
?>