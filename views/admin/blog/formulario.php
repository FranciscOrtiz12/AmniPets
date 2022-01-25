<fieldset>

    <legend>Informacion del Blog</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="blog[TITULO_BLOG]" id="titulo" placeholder="Titulo del Blog" value="<?php echo sani($blog->TITULO_BLOG); ?>">

    <label for="texto">Texto del Anuncio:</label>
    <textarea name="blog[TEXTO_BLOG]" id="texto"> <?php echo sani($blog->TEXTO_BLOG); ?></textarea>

    <label for="imagen">Imagen:</label>
    <input type="file" name="blog[FOTO]" id="imagen" accept="iamge/jpeg, image/png">
    <?php if($blog->FOTO){ ?>
        <img src="/imagenes/blogs/<?php echo $blog->FOTO; ?>" alt="Imagen Blog" style="width: 25rem;">
    <?php } ?>

</fieldset>