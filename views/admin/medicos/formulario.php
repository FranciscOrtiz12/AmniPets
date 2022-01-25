<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" name="medico[NOMBRE_MED]" id="nombre" placeholder="Nombre del Medico" value="<?php echo sani($medico->NOMBRE_MED) ?>">

    <label for="apellido">Apellidos:</label>
    <input type="text" name="medico[APELLIDO_MED]" id="apellido" placeholder="Apellidos del Medico" value="<?php echo sani($medico->APELLIDO_MED) ?>">

    <label for="especialidad">Especialidad:</label>
    <input type="text" name="medico[ESPECIALIDAD_MED]" id="especialidad" placeholder="Especialidad" value="<?php echo sani($medico->ESPECIALIDAD_MED) ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="medico[FOTO]" id="imagen" accept="image/jpeg, image/png">
    <?php if($medico->FOTO){ ?>
        <img src="/imagenes/medicos/<?php echo $medico->FOTO; ?>" alt="Imagen Medico" style="width: 25rem;">
    <?PHP } ?>
    
</fieldset>