<main class="contenedor seccion">
    <h1>Gestion de Anuncios</h1>

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
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $anuncios as $anuncio){?>
                <tr class="lis">
                    <td> <?php echo $anuncio->ID; ?> </td>
                    <td> <?php echo $anuncio->TITULO_ANUN; ?> </td>
                    <td> <?php echo $anuncio->TEXTO_ANUN; ?> </td>
                    <td> <?php echo $anuncio->CREADO_ANUN; ?> </td>

                    <td class="acciones">
                        <form method="POST" action="/admin/anuncios/eliminar">

                            <input type="hidden" name="id" value="<?php echo $anuncio->ID; ?>">
                            <input type="hidden" name="tipo" value="anuncio">
                            <input type="image" src="/build/img/papelera-de-reciclaje.webp" class="icono-accion">

                        </form>

                        <a href="/admin/anuncios/actualizar?id=<?php echo $anuncio->ID; ?>"> <img src="/build/img/editar.webp" class="icono-accion" alt="Icono Editar"> </a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a class="boton boton-verde" href="/admin/anuncios/crear">Nuevo Anuncio</a>
</main>