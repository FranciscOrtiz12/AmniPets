<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="anuncio[TITULO_ANUN]" id="titulo" placeholder="Titulo del Anuncio" value="<?php echo sani($anuncio->TITULO_ANUN); ?>">

    <label for="texto">Texto del Enunciado:</label>
    <textarea name="anuncio[TEXTO_ANUN]" id="texto"> <?php echo sani($anuncio->TEXTO_ANUN); ?></textarea>
    
</fieldset>