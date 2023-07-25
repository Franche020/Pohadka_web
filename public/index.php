<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\AuthController;
use Controllers\ImagesController;
use Controllers\PaginaController;
use Controllers\EventosController;
use Controllers\ReservasController;
use Controllers\HabitacionController;

$router = new Router();


// Pagina principal

$router->get('/', [PaginaController::class, 'index']);
$router->get('/room', [PaginaController::class, 'room']);

// Eventos
$router->get('/events', [EventosController::class, 'index']);

// Habitaciones
$router->get('/acommodation', [ReservasController::class, 'index']);
$router->get('/acommodation/confirm', [ReservasController::class, 'confirm']);
$router->post('/acommodation/confirm', [ReservasController::class, 'confirm']);


// API
$router->post('/api/rooms', [APIController::class, 'rooms']);
$router->post('/api/room', [APIController::class, 'room']);

// Admin
$router->get('/admin', [HabitacionController::class, 'index']); // TODO cambiar a otro controlador
// Admin Habitaciones
$router->get('/admin/acommodation', [HabitacionController::class, 'admin']);
$router->get('/admin/acommodation/create', [HabitacionController::class, 'create']);
$router->post('/admin/acommodation/create', [HabitacionController::class, 'create']);
$router->post('/admin/acommodation/delete', [HabitacionController::class, 'delete']);
$router->get('/admin/acommodation/update', [HabitacionController::class, 'update']);
$router->post('/admin/acommodation/update', [HabitacionController::class, 'update']);
$router->post('/admin/acommodation/image/delete',[ImagesController::class, 'deleteAcommodationImage']);
$router->get('/admin/acommodation/image/update',[ImagesController::class, 'updateAcommodationImage']);
$router->post('/admin/acommodation/image/update',[ImagesController::class, 'updateAcommodationImage']);
        // Admin Eventos
$router->get('/admin/events', [EventosController::class, 'admin']);
$router->get('/admin/events/create', [EventosController::class , 'create']);
$router->post('/admin/events/create', [EventosController::class , 'create']);
$router->post('/admin/events/delete', [EventosController::class, 'delete']);
$router->get('/admin/events/update',[EventosController::class, 'update']);
$router->post('/admin/events/update',[EventosController::class, 'update']);
$router->post('/admin/events/image/delete',[ImagesController::class, 'deleteEventImage']);
$router->get('/admin/events/image/update',[ImagesController::class, 'updateEventImage']);
$router->post('/admin/events/image/update',[ImagesController::class, 'updateEventImage']);

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registration', [AuthController::class, 'registro']);
$router->post('/registration', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/remember', [AuthController::class, 'olvide']);
$router->post('/remember', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reset', [AuthController::class, 'reestablecer']);
$router->post('/reset', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/message', [AuthController::class, 'mensaje']);
$router->get('/confirm-account', [AuthController::class, 'confirmar']);


// IMAGENES
$router->post('/upload', [ImagesController::class, 'uploadImage']);



$router->comprobarRutas();