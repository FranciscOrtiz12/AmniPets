<?php

    if(!isset($_SESSION)){
        session_start();
    };
    $auth = $_SESSION['login'] ?? false;
    $admin = $_SESSION['admin'] ?? "0";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmniPets</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="shortcut icon" href="/build/img/logoT.png">
</head>

<body>
    
    <header class="header">
        
        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="/">
                    <img class="logoBarra" src="/build/img/logoT.png" alt="Logo Veterinaria">
                </a>

                <div class="mobile-menu">
                    <img id="ides" src="/build/img/barras.svg" alt="Icono Menu">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" class="dark-mode-boton" alt="Boton DarkMode">

                    <nav class="navegacion" data-cy="navegacion-header">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/servicios">Servicios</a>
                        <a href="/blogs">Blog</a>
                        <a href="/anuncios">Anuncios</a>
                        <a href="/contacto">Contacto</a>
                        <?php if( $auth && $admin === "1" ){  ?>
                            <a href="/admin">Administracion</a> 
                            <a href="/logout">Cerrar Sesión</a>
                        <?php }elseif( $auth ){?>
                            <a href="/cliente">Mi Perfil</a>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php }else{?>
                            <a href="/login">Iniciar Sesión</a>
                        <?php } ?>

                    </nav>
                </div>
            </div> <!-- Cierre de la barra -->
        </div>

    </header>
    
    <?php echo $contenido; ?>

    <footer class="footer">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion" data-cy="navegacion-footer">
                <a href="/nosotros">Nosotros</a>
                <a href="/servicios">Servicios</a>
                <a href="/blogs">Blog</a>
                <a href="/anuncios">Anuncios</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos Los Derechos Reservados &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
    <?php echo $script ?? ''; ?>
</body>

</html>