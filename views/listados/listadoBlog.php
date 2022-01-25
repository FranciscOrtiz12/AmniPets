<!-- substr($anuncio->TEXTO_ANUN, 0 ,6) -->

<section class="contenedor seccion">

    <?php foreach($blogs as $blog) {?>
        <div id="blog">
            <a href="/blog?id=<?php echo $blog->ID; ?>"><p class="titulo"> <?php echo $blog->TITULO_BLOG; ?> </p></a>
            <hr>

            <div class="calendario">
                <img src="build/img/calendar.webp" alt="calendario">
                <a class="fecha" href="/blog?id=<?php echo $blog->ID; ?>"> <?php echo $blog->CREADO_BLOG; ?> </a>
            </div>

            <a href="/blog?id=<?php echo $blog->ID; ?>">
                <img loading="lazy" src="/imagenes/blogs/<?php echo $blog->FOTO; ?>" alt="Imagen del Blog">
            </a>

            <div class="contenido-blog">
                <p> <?php echo substr($blog->TEXTO_BLOG, 0 ,250) . "..."; ?></p>
                <a href="/blog?id=<?php echo $blog->ID; ?>" class="boton boton-rosa">Ver Entrada</a>
            </div>

        </div>
    <?php } ?>
    
</section>