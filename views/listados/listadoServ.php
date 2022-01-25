<div class="servicios-listado">
    <?php foreach($servicios as $servicio): ?>
        <div class="servicios-lista" data-cy="servicio">
            <div class="imagen" data-cy="enlace-propiedad">
                <a href="/servicio?id=<?php echo $servicio->ID; ?>">
                    <img loading="lazy" src="/imagenes/servicios/<?php echo $servicio->FOTO; ?>" alt="Imagen del Servicio">
                </a>
            </div>
            <div class="servicio-contenido">
                <h3><?php echo $servicio->NOMBRE_SERV ?></h3>
                <p><?php echo substr($servicio->DESCRIPCION_SERV, 0, 40). "...";?></p>

            </div>
        </div>
    <?php endforeach ?>
</div>
