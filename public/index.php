<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AdminController;
use Controllers\AnunciosController;
use Controllers\APIController;
use Controllers\BlogController;
use Controllers\ClienteController;
use Controllers\ContenidoController;
use Controllers\LoginController;
use Controllers\MedicosController;
use Controllers\PaginasController;
use Controllers\ServiciosController;
use Model\Cliente;

$router = new Router;

    /****  ZONA PRIVADA ****/

//Peril Usuario
$router->get('/cliente',[ClienteController::class, 'index']);


//API de clientes
$router->get('/api/obtenermas', [APIController::class, 'obtenerMas']);
$router->get('/api/obtenercon', [APIController::class, 'obtenerCon']);
$router->post('/api/solicitarControl', [APIController::class, 'solicitarControl']);

//Zona Admin
$router->get('/admin',[AdminController::class, 'home']);
    //GESTION ANUNCIOS
$router->get('/admin/anuncios/index',[AnunciosController::class, 'index']);
$router->get('/admin/anuncios/crear',[AnunciosController::class, 'crear']);
$router->post('/admin/anuncios/crear',[AnunciosController::class, 'crear']);
$router->get('/admin/anuncios/actualizar',[AnunciosController::class, 'actualizar']);
$router->post('/admin/anuncios/actualizar',[AnunciosController::class, 'actualizar']);
$router->post('/admin/anuncios/eliminar',[AnunciosController::class, 'eliminar']);
    //GESTION BLOG
$router->get('/admin/blog/index',[BlogController::class, 'index']);
$router->get('/admin/blog/crear',[BlogController::class, 'crear']);
$router->post('/admin/blog/crear',[BlogController::class, 'crear']);
$router->get('/admin/blog/actualizar',[BlogController::class, 'actualizar']);
$router->post('/admin/blog/actualizar',[BlogController::class, 'actualizar']);
$router->post('/admin/blog/eliminar',[BlogController::class, 'eliminar']);

    //GESTION MEDICOS
$router->get('/admin/medicos/index',[MedicosController::class, 'index']);
$router->get('/admin/medicos/crear',[MedicosController::class, 'crear']);
$router->post('/admin/medicos/crear',[MedicosController::class, 'crear']);
$router->get('/admin/medicos/actualizar',[MedicosController::class, 'actualizar']);
$router->post('/admin/medicos/actualizar',[MedicosController::class, 'actualizar']);
$router->post('/admin/medicos/eliminar',[MedicosController::class, 'eliminar']);

    //GESTION SERVICIOS
$router->get('/admin/servicios/index',[ServiciosController::class, 'index']);
$router->get('/admin/servicios/crear',[ServiciosController::class, 'crear']);
$router->post('/admin/servicios/crear',[ServiciosController::class, 'crear']);
$router->get('/admin/servicios/actualizar',[ServiciosController::class, 'actualizar']);
$router->post('/admin/servicios/actualizar',[ServiciosController::class, 'actualizar']);
$router->post('/admin/servicios/eliminar',[ServiciosController::class, 'eliminar']);

    //LOGIN
    
// Iniciar Sesión
$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);
// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);
// Confirmar Cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//ZONA PUBLICA
$router->get('/',[PaginasController::class, 'home']);
$router->get('/nosotros',[PaginasController::class, 'nosotros']);
$router->get('/servicio',[PaginasController::class, 'servicio']);
$router->get('/servicios',[PaginasController::class, 'servicios']);
$router->get('/blogs',[PaginasController::class, 'blogs']);
$router->get('/blog',[PaginasController::class, 'blog']);
$router->get('/anuncio',[PaginasController::class, 'anuncio']);
$router->get('/anuncios',[PaginasController::class, 'anuncios']);
$router->get('/contacto',[PaginasController::class, 'contacto']);
$router->post('/contacto',[PaginasController::class, 'contacto']);
$router->get('/equipo',[PaginasController::class, 'equipo']);
$router->get('/medicos',[PaginasController::class, 'medicos']);


//GESTION CONTENIDO
$router->get('/admin/contenido/home',[ ContenidoController::class, 'home']);

$router->comprobarRutas();