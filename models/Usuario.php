<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono' ,'noRegistrado', 'confirmado','admin', 'token'];
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->noRegistrado = $args['noRegistrado'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->admin = $args['admin'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $noRegistrado;
    public $confirmado;
    public $admin;
    public $token;

    // Validar el Login de Usuarios
    // TODO convertir a validacion en dos idiomas

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error']['en'][] ='The user\'s email is required';
            self::$alertas['error']['cz'][] ='E-mail uživatele je povinný';

        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['en'][] ='Invalid email.';
            self::$alertas['error']['cz'][] ='Neplatný e-mail.';
        }
        if(!$this->password) {
            self::$alertas['error']['en'][] ='The password cannot be empty';
            self::$alertas['error']['cz'][] ='Heslo nemůže být prázdné';
        }
        return self::$alertas;

    }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        if(!$this->nombre) {
            self::$alertas['error']['en'][] = 'The name is required';
            self::$alertas['error']['cz'][] = 'Jméno je povinné';
        }
        if(!$this->apellido) {
            self::$alertas['error']['en'][] = 'The last name is required';
            self::$alertas['error']['cz'][] = 'Příjmení je povinné';
        }
        if(!$this->email) {
            self::$alertas['error']['en'][] = 'The email is required';
            self::$alertas['error']['cz'][] = 'E-mail je povinný';
        }
        if(!$this->password) {
            self::$alertas['error']['en'][] = 'The password cannot be empty';
            self::$alertas['error']['cz'][] = 'Heslo nesmí být prázdné';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error']['en'][] = 'The password must be at least 6 characters long';
            self::$alertas['error']['cz'][] = 'Heslo musí obsahovat minimálně 6 znaků';
        }
        // if($this->password !== $this->password2) {
        //     self::$alertas['error'][] = 'Los password son diferentes';
        // }
        return self::$alertas;
    }

    // Valida un email
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error']['en'][] = 'The email is required';
            self::$alertas['error']['cz'][] = 'E-mail je povinný';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error']['en'][] = 'Invalid email';
            self::$alertas['error']['cz'][] = 'Neplatný e-mail';
        }
        return self::$alertas;
    }

    // Valida el Password 
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error']['en'][] = 'The password cannot be empty';
            self::$alertas['error']['error'][] = 'Heslo nemůže být prázdné';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error']['en'][] = 'The password must be at least 6 characters long';
            self::$alertas['error']['cz'][] = 'Heslo musí obsahovat minimálně 6 znaků';
        }
        return self::$alertas;
    }

    // public function nuevo_password() : array {
    //     if(!$this->password_actual) {
    //         self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
    //     }
    //     if(!$this->password_nuevo) {
    //         self::$alertas['error'][] = 'El Password Nuevo no puede ir vacio';
    //     }
    //     if(strlen($this->password_nuevo) < 6) {
    //         self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
    //     }
    //     return self::$alertas;
    // }

    // Comprobar el password
    public function comprobar_password($password) : bool {
        return password_verify($password, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}