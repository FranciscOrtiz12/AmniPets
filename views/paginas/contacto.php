<?php
        include '../views/templates/contacto.php';
    ?>
<main class="contenedor">
    
    <div class="seccion">
    <h2 data-cy="heading-formulario">Llene el Formulario de Contacto</h2>

        <?php if($mensaje1){ ?>
            <p class='alerta exito'> <?php echo $mensaje1 ?> </p>
        <?php } ?>

        <?php if($mensaje2){ ?>
            <p class='alerta exito'> <?php echo $mensaje2 ?> </p>
        <?php } ?>


    <form class="formulario" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[NOMBRE_CON]" required>

        </fieldset>

        <fieldset>
            <legend>Información a Consultar</legend>

            <label for="opciones">Informacion de:</label>
            <select id="opciones" name="contacto[ACERCADE_CON]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Cita Medica">Cita Medica</option>
                <option value="Servicios">Servicios</option>
                <option value="Precios">Precios</option>
                <option value="Otro">Otro</option>
            </select>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[MENSAJE_CON]" required></textarea>

        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser Contacto:</p>
            
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[METODO_CON]" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[METODO_CON]" required>

            </div>

            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
    </div>


</main>