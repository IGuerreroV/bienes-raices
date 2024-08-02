<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Vivamus congue, tortor maximus viverra scelerisque, odio libero varius nisi, quis rhoncus libero massa venenatis felis. Proin condimentum, eros quis sollicitudin tempus, dolor elit pharetra nisl, scelerisque ornare felis sapien vel turpis. Curabitur dignissim elementum consectetur. Sed tincidunt turpis vitae ante suscipit sodales. Ut molestie vulputate mauris ac dapibus. Etiam non euismod eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

            <p>Aenean ut nisl at nisi auctor cursus. Donec consequat ipsum eu nunc imperdiet, facilisis aliquet risus eleifend. In vel aliquam tellus. Phasellus iaculis dolor lorem, pretium egestas risus molestie id. Vestibulum viverra pulvinar elit, sed malesuada tortor porta at. Maecenas fringilla egestas quam at ultricies. Aenean in dui vitae ipsum ultrices tristique tristique sed odio. Vestibulum vel ullamcorper eros, sit amet molestie justo. Sed at mattis erat. Nam mi turpis, gravida a ultricies sit amet, mattis vitae magna. Nulla facilisi.</p>
        </div>
    </main>

<?php
    incluirTemplate('footer')
?>