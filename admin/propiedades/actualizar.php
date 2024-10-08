<?php
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    require '../../includes/app.php';
     // Autenticado
    estaAutenticado();
    $tipo = 'propiedades';

    // Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('location: /admin');
    }

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // echo '<pre>';
    // var_dump($propiedad);
    // echo '</pre>';

    // Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        // Validacion
        $errores = $propiedad->validar();

        // Obtener la carpeta de imagenes correspondiente
        $carpetaImagenes = getCarpetaImagenes($tipo);
        
        // Subida de archivos
        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);
            $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }
        // Revisar que el array de errores este vacio
        if(empty($errores)) {
            // Almacenar la imagen
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save($carpetaImagenes . $nombreImagen);
            }
            
            $propiedad->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a class="boton boton-verde" href="/admin">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input class="boton boton-verde" type="submit" value="Actualizar Propiedad">
        </form>
    </main>

<?php
    incluirTemplate('footer')
?>