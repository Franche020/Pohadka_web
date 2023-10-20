<?php

namespace Controllers;

use Model\Habitacion;
use Model\Reservas;
use Model\ReservasHabitaciones;
use Model\Usuario;
use MVC\Router;

class ReservasController
{

    public static function index(Router $router) {
        startSession();
        $router->render('acommodation/index', []);
    }
    
    public static function confirm(Router $router) {

        // Definir todas las variables Iniciales
        $usuario = [];
        $alertas = [];
        $lenguaje = lenguaje();
        startSession();
        $roomNumber = null;
        // Validaciones de elementos del GET
        // TODO Corregir lo de abajo para que lo asigne 
        if (isset($_GET['roomNumber'])){
            $roomNumber = filter_var($_GET['roomNumber'], FILTER_VALIDATE_INT);
        }
        validarFecha($_GET['checkIn']) ? $checkIn = $_GET['checkIn'] : header('location: /acommodation');
        validarFecha($_GET['checkOut']) ? $checkOut = $_GET['checkOut'] : header('location: /acommodation');
        // Validacion tipo habitacion
        if (validarTipoHabitacion($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
        } else {
            header('location: /acommodation');
        }

        // Obtencion del objeto Habitacion
        if ($tipo === 'room') {
            $acommodation = Habitacion::where('castillo', $roomNumber);
            debuguear($acommodation);
        } else {
            $acommodation = Habitacion::where('tipo', $tipo);
            //debuguear($tipo);
        }

        // Array asociativo para el objeto
        $argsRes = [
            'fecha_inicio' => $checkIn,
            'fecha_fin' => $checkOut,
            'fecha_reserva' => date('Y,m,d')
        ];

        // Validar si el usuario esta logado o no
        if (isset($_SESSION['id'])) {
            //* Si está logado
            $argsRes['usuarioId'] = $_SESSION['id'];
            // Si esta logado guardar la reserva con metodo POST
            $reserva = new Reservas($argsRes);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Guardado Reservas
                $resultadoReserva = $reserva->guardar();
                // Guardado ReservaHabitaciones
                $argsResHab['reservaId'] = $resultadoReserva['id'];
                $argsResHab['habitacionId'] = $acommodation->id;
                $reservaHabitacion = new ReservasHabitaciones($argsResHab);
                $resultadoReservaHabitacion = $reservaHabitacion->guardar();


                // Enviar Mail al usuario
                // TODO Enviar email al usuario
                // Redireccionar a la siguiente
                $header = 'location: /acommodation/done?id=' . $resultadoReservaHabitacion['id'];
                header($header);
            }


        } else {
            //* Si no está logado
            $reserva = new Reservas($argsRes);


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // Si no está logado validar si el usuario existe
                $usuario = Usuario::where('email', $_POST['usuario']['email']);
                $idUsuario = '';
                $alertas = [];

                //Gestion del usuario
                if ($usuario !== null) {
                    // Si Usuario existe
                    if ($usuario->confirmado === '1'){
                        // Si el usuario ya existe sacar aviso
                        $alertas['error']['en'][] = 'The user already exists, please log in';
                        $alertas['error']['cz'][] = 'Uživatel již existuje, prosím přihlaste se';
                    } else {
                        // Si no está confirmado

                        // Sincronizar el usuario existente
                        $usuario->sincronizar($_POST['usuario']);
                        $alertas = $usuario->validar_temporal();
                        // Si no hay alertas
                        if(empty($alertas)) {
                            // guardar el usuario
                            $resultadoUsuario = $usuario->guardar();
                            $idUsuario = $resultadoUsuario['id'];
                         }

                    }
                } else {
                    // Si no existe crear el usuario temporal

                    $usuario = [];
                    $usuario = new Usuario($_POST['usuario']);
                    $usuario->noRegistrado = 1;

                    // validar el usuario temporal
                    $alertas = $usuario->validar_temporal();
                    // Si no hay alertas
                    if(empty($alertas)) {
                        // guardar el usuario
                       $resultadoUsuario = $usuario->guardar();
                       $idUsuario = $resultadoUsuario['id'];
                    }

                }

                if(empty($alertas)){
                    
                    $reserva->usuarioId = $idUsuario;
                    $resultadoReserva = $reserva->guardar();

                    $argsResHab['reservaId'] = $resultadoReserva['id'];
                    $argsResHab['habitacionId'] = $acommodation->id;
                    $reservaHabitacion = new ReservasHabitaciones($argsResHab);
                    $resultadoReservaHabitacion = $reservaHabitacion->guardar();
    
                    if ($resultadoReservaHabitacion['resultado'] && $resultadoReserva['resultado'] && $resultadoUsuario) {
    
                        // TODO Enviar email al usuario
                        $header = 'location: /acommodation/done?id=' . $resultadoReservaHabitacion['id'];
                        header($header);
                    }

                }
        
            }
        }

        $router->render('acommodation/confirmar', [
            'titulo' => 'Confirmation',
            'reserva' => $reserva,
            'tipo' => $tipo,
            'usuario' => $usuario,
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function reservaHecha(Router $router) {
        startSession();
        $id = validarORedireccionar('/');

        $reserva = ReservasHabitaciones::getDatosReservaId($id);
        //debuguear($reserva);

        $router->render('/acommodation/resumen-final', [
            'reserva' => $reserva['0']
        ]);
    }
}
