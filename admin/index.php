<?php
    // Autenticado
    require '../includes/app.php';
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    debuguear($vendedores);

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            $propiedad = Propiedad::find($id);

            $propiedad->eliminar();

        }

        // var_dump($id);
    }

    // Incluye un template
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if(intval( $resultado ) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif(intval( $resultado ) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif(intval( $resultado ) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>

        <a class="boton boton-verde" href="/admin/propiedades/crear.php">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $propiedades as $propiedad ):  ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form class="w-100" method="POST">

                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">

                            <input type="submit" class="boton-rojo-block"  value="Eliminar">
                        </form>
                        
                        <a class="boton-amarillo-block" href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php

    // Cerrar la conexion
    mysqli_close($db);

    incluirTemplate('footer');
?>