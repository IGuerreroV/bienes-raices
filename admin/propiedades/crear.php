<?php
    // Autenticado
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    estaAutenticado();

    // Base de datos
    $db = conectarDB();

    $propiedad = new Propiedad;

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // debuguear($errores);

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        /* Crea una nueva Instancia */
        $propiedad = new Propiedad($_POST['propiedad']);

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

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el array de errores este vacio
        if(empty($errores)) {

            // Crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de datos
            $resultado = $propiedad->guardar();

            // Mensaje de exito o error
            if($resultado) {
                // Redireccionar al usuario.
                header('Location: /admin?resultado=1');
            }
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