<div class="login-logo">
    <img src="/build/img/logoT.png" alt="Logo Veterinaria">
</div>

<section class="caja">
    <h1 class="nombre-pagina">Crear Cuenta</h1>
    <p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form class="formulario" method="POST" action="/crear-cuenta">

        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo sani($usuario->nombre) ?>">
        </div>

        <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo sani($usuario->apellido) ?>">
        </div>

        <div class="campo">
            <label for="rut">Rut:</label>
            <input type="text" id="rut" name="rut" placeholder="12345678-9" value="<?php echo sani($usuario->rut) ?>">
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo sani($usuario->telefono) ?>">
        </div>

        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Tu E-mail" value="<?php echo sani($usuario->email) ?>">
        </div>

        <div class="campo">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Tu Password">
        </div>

        <input type="submit" value="Crear Cuenta" class="boton boton-rosa">

    </form>

    <div class="login-acciones">
        <a href="/login">¿Ya tienes una cuenta? Inicia Sesion</a>
        <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
</section>