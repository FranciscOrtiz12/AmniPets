<main class="contenedor seccion">

    <a href="/servicios" class="boton boton-rosa">Volver</a>
    <h1 class="cabecera"> <?php echo $servicio->NOMBRE_SERV; ?> </h1>

    <div class="servicio">

        <div id="blog">
            <img loading="lazy" src="/imagenes/servicios/<?php echo $servicio->FOTO; ?>" alt="Imagen del Servicio">

            <div class="contenido-blog">
                <p> <?php echo $servicio->DESCRIPCION_SERV; ?></p>
            </div>

        </div>

        <aside class="medico">
            
            <div class="lista">
                <img loading="lazy" src="/imagenes/medicos/<?php echo $medico->FOTO?>" alt="Foto del Medico">

                <div class="contenido-listado">
                    <h3><?php echo $medico->NOMBRE_MED . " " . $medico->APELLIDO_MED; ?></h3>
                    <p class="especialidad"><?php echo $medico->ESPECIALIDAD_MED; ?></p>
                </div> <!-- Contenido Anuncio -->
            </div> <!-- Anuncio -->

        </aside>

    </div>
</main>