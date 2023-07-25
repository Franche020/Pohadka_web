<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion($lenguaje)
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('accounts@pohadka.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Account verification';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        // TODO lenguaje
        if ($lenguaje === 'cs-CZ') {
            $contenido = '<html>';
            $contenido .= "<p><strong>Ahoj " . $this->nombre . "</strong> Úspěšně jste se zaregistrovali na Pohadka, ale je nutné účet potvrdit.</p>";
            $contenido .= "<p>Klikněte zde: <a href='" . $_ENV['HOST'] . "/confirm-account?token=" . $this->token . "'>Potvrdit účet</a>";
            $contenido .= "<p>Pokud jste tento účet nevytvořili, můžete tuto zprávu ignorovat.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
        } else {
            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> You have successfully registered your account at Pohadka, but it needs to be confirmed.</p>";
            $contenido .= "<p>Click here: <a href='" . $_ENV['HOST'] . "/confirm-account?token=" . $this->token . "'>Confirm Account</a>";
            $contenido .= "<p>If you did not create this account, you can ignore this message.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
        }

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones($lenguaje)   
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        if ($lenguaje === 'cs-CZ') {
            $contenido = '<html>';
            $contenido .= "<p><strong>Ahoj " . $this->nombre .  "</strong> Požádal(a) jste o obnovení vašeho hesla. Pro pokračování postupujte podle následujícího odkazu.</p>";
            $contenido .= "<p>Klikněte zde: <a href='" . $_ENV['HOST'] . "/reset?token=" . $this->token . "'>Obnovit heslo</a>";
            $contenido .= "<p>Pokud jste tuto změnu nevyžádali, můžete tuto zprávu ignorovat.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
        } else {
            $contenido = '<html>';
            $contenido .= "<p><strong>Hello " . $this->nombre .  "</strong> You have requested to reset your password. Please follow the link below to proceed.</p>";
            $contenido .= "<p>Click here: <a href='" . $_ENV['HOST'] . "/reset?token=" . $this->token . "'>Reset Password</a>";
            $contenido .= "<p>If you did not request this change, you can ignore this message.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
        }
        //Enviar el mail
        $mail->send();
    }
}
