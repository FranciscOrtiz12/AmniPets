<div class="login-logo">
    <img src="/build/img/logoT.png" alt="Logo Veterinaria">
</div>

<section class="caja">
    <h1 class="nombre-pagina">Olvide Password</h1>
    <p class="descripcion-pagina">Reestablece tu password escribiendo tu E-mail</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form class="formulario" action="/olvide" method="POST">
        <div class="campo">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Tu E-mail">
        </div>

        <input type="submit" class="boton boton-rosa" value="Enviar Instrucciones">
    </form>

    <div class="login-acciones">
        <a href="/login">¿Ya tienes una cuenta? Inicia Sesion</a>
        <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear Una</a>
    </div>
</section>