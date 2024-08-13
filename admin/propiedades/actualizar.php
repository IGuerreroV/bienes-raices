<?php
    use App\Propiedad;
use Intervention\Image\Colors\Profile;

    require '../../includes/app.php';
     // Autenticado
    estaAutenticado();

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

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        $errores = $propiedad->validar();

        // Revisar que el array de errores este vacio
        if(empty($errores)) {

            // Crear carpeta'
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            /* SUBIDA DE ARCHIVOS */

            if($imagen['name']) {
                // Eliminar la imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

                // Subir imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }

            // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedores_id = {$vendedores_id} WHERE id = {$id}";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario.
                header('Location: /admin?resultado=2');
            }
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