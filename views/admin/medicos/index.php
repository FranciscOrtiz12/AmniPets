<main class="contenedor seccion">
    <h1>Gestion de Medicos</h1>

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
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Especialidad</th>
                <th>Foto</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $medicos as $medico ): ?>
                <tr class="lis">
                    <td> <?php echo $medico->ID; ?> </td>
                    <td> <?php echo $medico->NOMBRE_MED; ?> </td>
                    <td> <?php echo $medico->APELLIDO_MED; ?> </td>
                    <td> <?php echo $medico->ESPECIALIDAD_MED; ?> </td>
                    <td> <img src="/imagenes/medicos/<?php echo $medico->FOTO ?>" alt="Imagen del Medico" class="imagen-tabla"> </td>

                    <td class="acciones">
                        <form method="POST" action="/admin/medicos/eliminar">

                            <input type="hidden" name="id" value="<?php echo $medico->ID; ?>">
                            <input type="hidden" name="tipo" value="medico">
                            <input type="image" src="/build/img/papelera-de-reciclaje.webp" class="icono-accion">

                        </form>

                        <a href="/admin/medicos/actualizar?id=<?php echo $medico->ID; ?>"> <img src="/build/img/editar.webp" class="icono-accion" alt="Icono Editar"> </a>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>

    <a class="boton boton-verde" href="/admin/medicos/crear">Nuevo Medico</a>

</main>