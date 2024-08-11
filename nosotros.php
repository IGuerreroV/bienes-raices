<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Atque facere necessitatibus recusandae, omnis doloremque inventore vel, sunt possimus molestias magni enim rerum cupiditate pariatur. Ullam libero praesentium eaque est obcaecati.</p>

                <p>Dolorum non accusantium quam, accusamus aliquid minus vitae cumque repellendus quisquam reiciendis minima quod! Exercitationem est beatae officiis quo tempore aliquam accusantium.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>adipisicing elit. Iure deleniti aliquid veritatis sequi corrupti, ipsa quis deserunt soluta, delectus, modi eum quia ipsam libero tempore repellat asperiores doloremque officia doloribus?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>adipisicing elit. Iure deleniti aliquid veritatis sequi corrupti, ipsa quis deserunt soluta, delectus, modi eum quia ipsam libero tempore repellat asperiores doloremque officia doloribus?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>adipisicing elit. Iure deleniti aliquid veritatis sequi corrupti, ipsa quis deserunt soluta, delectus, modi eum quia ipsam libero tempore repellat asperiores doloremque officia doloribus?</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer')
?>