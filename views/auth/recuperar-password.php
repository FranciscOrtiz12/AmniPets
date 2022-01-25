<div class="login-logo">
    <img src="/build/img/logoT.png" alt="Logo Veterinaria">
</div>

<section class="caja">
    <h1 class="nombre-pagina">Recuperar Password</h1>
    <p class="descripcion-pagina">Ingresa tu nuevo password a continuación</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <?php if($error) return; ?>

    <form class="formulario" method="POST">
        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Tu Nuevo Password">
        </div>
        <input type="submit" class="boton boton-rosa" value="Guardar Nuevo Password">
    </form>

    <div class="login-acciones">
        <a href="/login">¿Ya tienes cuenta? Iniciar Sesión</a>
        <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea Una</a>
    </div>
</section>