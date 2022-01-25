<div class="contenedor-listados">
    
    <?php foreach($anuncios as $anuncio) { ?>
        
    <div class="lista <?php echo $i; ?>">
            
        <div class="contenido-listado">
            <h3><?php echo $anuncio->TITULO_ANUN; ?></h3>
            <!-- aca falta la fecha -->
            <p>Creado el: <span> <?php echo $anuncio->CREADO_ANUN ?> </span></p>
            <p><?php echo $anuncio->TEXTO_ANUN; ?></p>
        </div> <!-- Contenido Anuncio -->
    </div> <!-- Anuncio -->
    <?php } ?>
</div> <!-- Contenedor Anuncios -->