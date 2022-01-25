<section class="imagen-inicio sombra"> <!-- INICIO IMAGEN PRINCIPAL -->
    <div class="sombra">
        <div class="cont">
            <h3 data-cy="heading-sitio">Dale a tu Mascota</h3>
            <p>el mejor cuidado</p>
            <a href="/contacto" class="boton boton-rosa">Contactanos</a>
        </div>
    </div>
</section> <!-- FIN IMAGEN PRINCIPAL -->


<!-- PORQUE NOSOTROS -->
<div class="contenedor seccion">
    <h3 data-cy="heading-nosotros">¿Porque Nosotros?</h3>

    <?php
        include '../views/templates/porqueNosotros.php';
    ?>
</div>

<section class="equipo"> <!-- INICIO SECCION EQUIPO -->
    <div class="sombra">
        <div class="contenedor seccion equipo-contenido">
            <img class="ce" src="build/img/equipo.webp" alt="Imagen Equipo de Trabajo">

            <div class="equipo-text">
                <h2>Nosotros</h2>
                <p>En AmniPets tratamos a nuestros queridos clientes peludos con gran
                de amor y devoción. Nuestros médicos son los mejores veterinarios de la provincia
                que garantizan que su mascota esté en un
                ambiente seguro y amigable.</p>
                <a href="/nosotros" class="boton boton-rosa">Más Informacion</a>
            </div>
        </div>
    </div>
</section><!-- FIN SECCION EQUIPO -->

<section class="contenedor seccion"> <!-- INICIO SECCION SERVICIOS -->
    <h2>Nuestros Servicios</h2>
    <hr><br>
    <?php
        include '../views/listados/listadoServ.php';
    ?>

    <div class="alinear-derecha">
        <a class="boton-rosa" href="/servicios" data-cy="ver-mas">Ver Más</a>
    </div>
</section> <!-- FIN SECCION SERVICIOS -->

<section class="seccion black"> <!-- INICIO SECCION BLOG -->
    <div class="contenedor">
        <h2>Desde el Blog</h2>

        <div class="contenedor-listados">
        <?php foreach($blogs as $blog) {?>
            <div class="blog" data-cy="listado-blogs">
                <a href="/blog?id=<?php echo $blog->ID; ?>">
                    <img loading="lazy" src="/imagenes/blogs/<?php echo $blog->FOTO; ?>" alt="Imagen del Blog">
                </a>

                <div class="contenido-blog">
                    <a href="/blog?id=<?php echo $blog->ID; ?>"> <h3><?php echo $blog->TITULO_BLOG; ?></h3> </a>
                    <div class="calendario icono">
                        <img src="build/img/calendar.webp" alt="calendario">
                        <a href="/blog?id=<?php echo $blog->ID; ?>" data-cy="enlace-blog"> <?php echo $blog->CREADO_BLOG; ?> </a>
                    </div>
                    <p> <?php echo substr($blog->TEXTO_BLOG, 0 ,90) . "..."; ?></p>
                </div>

            </div>
        <?php } ?>
    </div>

    <div class="alinear-derecha">
            <a class="boton-rosa" href="/blogs">Ver Todos</a>
        </div>
    </div>
</section> <!-- FIN SECCION BLOG -->

<section class="contenedor seccion"> <!-- INICIO SECCION ANUNCIOS -->

    <h2>Anuncios</h2>

    <?php
        include '../views/listados/listadoAnun.php';
    ?>

    <div class="alinear-derecha">
        <a class="boton-rosa" href="/anuncios">Ver Todos</a>
    </div>
</section> <!-- FIN SECCION ANUNCIOS -->

<?php
    include '../views/templates/contacto.php';
?>