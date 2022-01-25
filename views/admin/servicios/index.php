<main class="contenedor seccion">
    <h1>Gestion de Servicios</h1>

    <?php
     if($resultado){
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje){ ?>
            <p class="alerta exito"> <?php echo sani($mensaje); ?></p>
            <?php }          
    }?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <table class="listado">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Servicio</th>
                <th>Encargado</th>
                <th>Descripcion</th>
                <th>Foto</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $servicios as $servicio ): ?>
                <tr class="lis">
                    <td> <?php echo $servicio->ID; ?> </td>
                    <td> <?php echo $servicio->NOMBRE_SERV; ?> </td>
                    <td> <?php echo $servicio->NOMBRE_MED . " " . $servicio->APELLIDO_MED; ?> </td>
                    <td> <?php echo substr($servicio->DESCRIPCION_SERV, 0 ,50) . "..."; ?> </td>
                    <td> <img src="/imagenes/servicios/<?php echo $servicio->FOTO ?>" alt="Imagen del Servicio" class="imagen-tabla"> </td>

                    <td class="acciones">
                        <form method="POST" action="/admin/servicios/eliminar">

                            <input type="hidden" name="id" value="<?php echo $servicio->ID; ?>">
                            <input type="hidden" name="tipo" value="servicio">
                            <input type="image" src="/build/img/papelera-de-reciclaje.webp" class="icono-accion">

                        </form>

                        <a href="/admin/servicios/actualizar?id=<?php echo $servicio->ID; ?>"> <img src="/build/img/editar.webp" class="icono-accion" alt="Icono Editar"> </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a class="boton boton-verde" href="/admin/servicios/crear">Nuevo Servicio</a>
</main>