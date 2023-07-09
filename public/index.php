<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\EventosController;
use Controllers\HabitacionController;
use Controllers\ImagesController;
use MVC\Router;
use Controllers\PaginaController;

$router = new Router();


// Pagina principal

$router->get('/', [PaginaController::class, 'index']);

// Eventos
$router->get('/events', [EventosController::class, 'index']);
    // Admin Eventos
$router->get('/admin/events', [EventosController::class, 'admin']);
$router->get('/admin/events/create', [EventosController::class , 'create']);
$router->post('/admin/events/create', [EventosController::class , 'create']);
$router->post('/admin/events/delete', [EventosController::class, 'delete']);
$router->get('/admin/events/update',[EventosController::class, 'update']);
$router->post('/admin/events/update',[EventosController::class, 'update']);

// Habitaciones
$router->get('/acommodation', [HabitacionController::class, 'index']);
    // Admin Habitaciones
$router->get('/admin/acommodation', [HabitacionController::class, 'admin']);
$router->get('/admin/acommodation/create', [HabitacionController::class, 'create']);
$router->post('/admin/acommodation/create', [HabitacionController::class, 'create']);
$router->post('/admin/acommodation/delete', [HabitacionController::class, 'delete']);
$router->get('/admin/acommodation/update', [HabitacionController::class, 'update']);
$router->post('/admin/acommodation/update', [HabitacionController::class, 'update']);

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);


// IMAGENES
$router->post('/upload', [ImagesController::class, 'uploadImage']);



$router->comprobarRutas();