<div class="contenedor-listados">
    <?php foreach($medicos as $medico) { ?>
    <div class="lista">

        <img loading="lazy" src="/imagenes/medicos/<?php echo $medico->FOTO?>" alt="Foto del Medico">
        
                
        <div class="contenido-listado">
            <h3><?php echo $medico->NOMBRE_MED . " " . $medico->APELLIDO_MED; ?></h3>
            <p class="especialidad"><?php echo $medico->ESPECIALIDAD_MED; ?></p>
        </div> <!-- Contenido Anuncio -->
    </div> <!-- Anuncio -->
    <?php } ?>
</div> <!-- Contenedor Anuncios -->