<div class="app contenedor">

    <!-- Navegacion -->
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Mis Mascotas</button>
        <button type="button" data-paso="2">Historial de Controles</button>
        <button type="button" data-paso="3">Solicitar Control</button>
    </nav>
    <input id="rut" type="hidden" value="<?php echo $rut ?>"></h4>
    
        <!-- Listado de Mascotas -->
    <div id="paso-1" class="app-seccion mostrar">
        <h2 class="seccion-nombre">Tus Mascotas</h2>
        <p class="text-center">Estas son tus mascotas</p>
        <div id="mascotas" class="listado-mascotas">
        </div>
    </div> <!-- FIN PASO 1 -->

        <!-- Hisorial de Controles -->
    <div id="paso-2" class="app-seccion">
        <h2 class="seccion-nombre">Tus Controles</h2>
        <p class="text-center" >Este es el historial de controles medicos</p>
        <div id="controles" class="listado-mascotas">
        </div>
    </div> <!-- FIN PASO 2 -->

        <!-- Solicitud de Controles -->
    <div id="paso-3" class="app-seccion">
        <h2 class="seccion-nombre">Solicitud de Control</h2>
        <p class="text-center">Si deseas solicitar un control, rellena el siguiente formulario</p>

        <form id="solicitarControl" class="formulario" onsubmit="return sincronizarParar();" >

            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input
                    id="rut"
                    name="solicitud[rutCl]"
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre ?>"
                    disabled
                >
            </div>
            
            <div class="campo">
                <label for="mascota">Mascota: </label>
                <select name="solicitud[idMas]" id="mascota" require>
                    <option selected value="">-- Seleccione --</option>
                    <?php foreach( $mascotas as $mascota ): ?> 
                        <option value="<?php echo sani($mascota->ID) ?>"><?php echo sani($mascota->nombre_mas) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    id="fecha"
                    type="date"
                    name="solicitud[fecha]"
                    min="<?php echo date('Y-m-d') ?>"
                >
            </div>

            <div class="campo comentario">
                <label for="comentario">Comentario:</label>
                <textarea name="solicitud[comentario]" id="comentario" placeholder="Añade un Comentario"></textarea>
            </div>

        </form>
        
    </div> <!-- FIN PASO 3 -->

    <div class="paginacion">
        <button
        id="anterior"
        class="boton"
        >&laquo; Anterior</button>

        <button
        id="siguiente"
        class="boton"
        >Siguiente &raquo;</button>
    </div>
    
</div>

<?php
    $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/cliente.js'></script>
    ";
?>