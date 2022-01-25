<div class="login-logo">
    <img src="/build/img/logoT.png" alt="Logo Veterinaria">
</div>

<section class="caja">
    <p class="descripcion-pagina">Iniciar Sesión</p>

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
    <form class="formulario" action="/login" method="POST">
        <div class="campo">
            <label for="email">Email:</label>
            <br>
            <input type="email" id="email" placeholder="Tu Email" name="email" value="">
        </div>

        <div class="campo">
            <label for="password">Password:</label>
            <br>
            <input type="password" id="password" placeholder="Tu Password" name="password">
        </div>

        <input type="submit" class="boton boton-rosa" value="Iniciar Sesión">
    </form>

    <div class="login-acciones">
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea Una</a>
        <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
</section>