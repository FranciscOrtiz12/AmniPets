<main class="contenedor seccion">

    <div id="blog">
        <a href="/blogs" class="boton boton-rosa">Volver</a>
        <h2 class="cabecera" data-cy="titulo-blog"> <?php echo $blog->TITULO_BLOG; ?> </h2>
        <hr>

        <div class="calendario">
            <img class="icono-calendario" src="build/img/calendar.webp" alt="calendario">
            <p class="fecha"> <?php echo $blog->CREADO_BLOG; ?> </p>
        </div>

        <img loading="lazy" src="/imagenes/blogs/<?php echo $blog->FOTO; ?>" alt="Imagen del Blog">

        <div class="contenido-blog">
            <p> <?php echo $blog->TEXTO_BLOG; ?></p>
        </div>

    </div>
</main>