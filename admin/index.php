<?php
    // Autenticado
    require '../includes/app.php';
    estaAutenticado();

    // Importar clases
    use App\Propiedad;
    use App\Vendedor;

    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    // debuguear($vendedores);

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validar id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            $tipo = $_POST['tipo'];
            // debuguear($id);
            if(validarTipoContenido($tipo)) {
                // Compara lo que vamos a eliminar
                if($tipo === 'vendedor') {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } else if($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
        // debuguear($id);
    }
    // Incluye un template
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) : ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php endif; ?>
    
        <a class="boton boton-verde" href="/admin/propiedades/crear.php">Nueva Propiedad</a>
        <a class="boton boton-amarillo" href="/admin/vendedores/crear.php">Nuevo(a) Vendedor</a>

        <h2>Propiedades</h2>
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
                    <td> <img class="imagen-tabla" src="/imagenes/propiedades/<?php echo $propiedad->imagen; ?>"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block"  value="Eliminar">
                        </form>
                        
                        <a class="boton-amarillo-block" href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $vendedores as $vendedor ):  ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td> <img class="imagen-tabla" src="/imagenes/vendedores/<?php echo $vendedor->imagen; ?>"></td>
                    <td>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block"  value="Eliminar">
                        </form>
                        
                        <a class="boton-amarillo-block" href="admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php
    incluirTemplate('footer');
?>