<main class="contenedor ">

    <h1>Gestion de Blogs</h1>

    <?php
        if($resultado){
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje){ ?>
                <p class="alerta exito"> <?php echo sani($mensaje); ?> </p>
            <?php }
        }
    ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <table class="listado">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Texto</th>
                <th>Creado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $blogs  as $blog){?>
                <tr class="lis">
                    <td> <?php echo $blog->ID ?> </td>
                    <td> <?php echo $blog->TITULO_BLOG ?></td>
                    <td> <?php echo substr($blog->TEXTO_BLOG, 0 ,50) . "..."; ?> </td>
                    <td> <?php echo $blog->CREADO_BLOG ?></td>
                    <td> <img src="/imagenes/blogs/<?php echo $blog->FOTO?>" alt="Imagen del Blog" class="imagen-tabla"></td>

                    <td class="acciones">
                        <form method="POST" action="/admin/blog/eliminar">

                            <input type="hidden" name="id" value="<?php echo $blog->ID; ?>">
                            <input type="hidden" name="tipo" value="blog">
                            <input type="image" src="/build/img/papelera-de-reciclaje.webp" class="icono-accion">

                        </form>

                        <a href="/admin/blog/actualizar?id=<?php echo $blog->ID; ?>"> <img src="/build/img/editar.webp" class="icono-accion" alt="Icono Editar"> </a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a class="boton boton-verde" href="/admin/blog/crear">Nueva Entrada</a>
</main>