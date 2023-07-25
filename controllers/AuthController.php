<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        $lenguaje = lenguaje();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $usuario = new Usuario($_POST);
            //debuguear($usuario);

            $alertas = $usuario->validarLogin();
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmado ) {
                    Usuario::setAlerta('error','en', 'The user does not exist or is not confirmed');
                    Usuario::setAlerta('error','cz', 'Uživatel neexistuje nebo není potvrzený');
                } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin ?? null;
                        
                    } else {
                        Usuario::setAlerta('error','en', 'Incorrect Password');
                        Usuario::setAlerta('error','cz', 'Nesprávné heslo');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Login',
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
    }

    public static function registro(Router $router) {
        $lenguaje = lenguaje();

        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') { 
            
            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar_cuenta();
            
            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($existeUsuario && $existeUsuario->noRegistrado === 0) {
                    Usuario::setAlerta('error','en', 'The user is already registered');
                    Usuario::setAlerta('error','cz', 'Uživatel je již registrován');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();
                    
                    // Generar el Token
                    $usuario->crearToken();
                    //TODO debugear esto
                    //debuguear($usuario);
                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();
                    
                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion($lenguaje);
                    
                    //debuguear($email);

                    if($resultado) {
                        header('Location: /message'); // TODO redireccionar correctamente
                    }
                }
            }
        }

        // Render a la vista
        $router->render('auth/registration', [
            'titulo' => 'Create Your Account',
            'usuario' => $usuario, 
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function olvide(Router $router) {
        $lenguaje = lenguaje();

        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    //unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarInstrucciones($lenguaje);


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alertas['exito']['en'][] = 'We have sent the instructions to your email';
                    $alertas['exito']['cz'][] = 'Pokyny jsme odeslali na váš e-mail';


                    // Esperar 3 segundos antes de redireccionar
                    header("refresh:3 ;url=/login");
                } else {
                 
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alertas['error']['en'][] = 'The user does not exist or is not confirmed';
                    $alertas['error']['cz'][] = 'Uživatel neexistuje nebo není potvrzený';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/recordar', [
            'titulo' => 'recover password',
            'alertas' => $alertas,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function reestablecer(Router $router) {
        $lenguaje = lenguaje();

        $token = s($_GET['token']);

        $tokenValido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error','en', 'Invalid Token, please try again');
            Usuario::setAlerta('error','cz', 'Neplatný token, zkuste to znovu prosím');
            $tokenValido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'New Password',
            'alertas' => $alertas,
            'tokenValido' => $tokenValido,
            'lenguaje' => $lenguaje
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => 'Account Created'
        ]);
    }

    public static function confirmar(Router $router) {
        $lenguaje = lenguaje();
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');
        
        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);
        //debuguear($usuario);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error','en', 'Invalid Token');
            Usuario::setAlerta('error','cz', 'Neplatný token');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito','en', 'Cuenta Comprobada Correctamente');
            Usuario::setAlerta('exito','cz', 'Cuenta Comprobada Correctamente');
            
        }
        //debuguear(Usuario::getAlertas());
     

        $router->render('auth/confirmar', [
            'titulo' => 'Confirm your account',
            'alertas' => Usuario::getAlertas(),
            'lenguaje' => $lenguaje
        ]);
    }
}