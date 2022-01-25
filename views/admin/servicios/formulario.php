<fieldset>
    <legend>Informacion Del Servicio</legend>

    <label for="nombre">Nombre del Servicio</label>
    <input type="text" id="nombre" placeholder="Nombre del Servicio" name="servicio[NOMBRE_SERV]" value="<?php echo sani($servicio->NOMBRE_SERV) ?>">

    <label for="descripcion">Descripción:</label>
    <input type="text" name="servicio[DESCRIPCION_SERV]" id="descripcion" placeholder="Descripción del Servicio" value="<?php echo sani($servicio->DESCRIPCION_SERV) ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="servicio[FOTO]" id="imagen" accept="image/jpeg, image/png">
    <?php if($servicio->FOTO){ ?>
        <img src="/imagenes/servicios/<?php echo $servicio->FOTO; ?>" alt="Imagen del Servicio" style="width: 25rem;">
    <?PHP } ?>

</fieldset>

<fieldset>
    <legend>Medico Encargado</legend>

    <select name="servicio[ID_MED]" id="medico">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($medicos as $medico): ?>
            <option <?php echo $servicio->ID_MED === $medico->ID ? 'selected' : ''; ?> value="<?php echo sani($medico->ID); ?>"> <?php echo sani($medico->NOMBRE_MED) . " " . sani($medico->APELLIDO_MED); ?> </option>
        <?php endforeach ?>
    </select>
</fieldset>