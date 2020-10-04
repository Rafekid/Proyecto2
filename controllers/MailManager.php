<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 10/4/2020
 * Time: 12:24 AM
 */

require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');
require_once('PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MailManager{
    public static $instance;

    public static function instance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function sendWelcomeMail($to, $name){
        $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'bankumg92@gmail.com';                 // SMTP username
        $mail->Password = 'w)FqY3mW[anHL)).';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;

        $mail->From = 'bankumg92@gmail.com';
        $mail->FromName = 'UMG-Bank';
        $mail->addAddress($to, $name);     // Add a recipient
        $mail->addReplyTo('bankumg92@gmail.com', 'Bank-UMG');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $reference = base64_encode(serialize($to));


        $mail->Subject = 'Bienvenido a UMG-Bank';
        $mail->Body    = '<!doctype html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> <meta http-equiv="X-UA-Compatible" content="ie=edge"> <title>Welcome</title> </head> <body> <h1>Bienvenido a UMG-Bank</h1> <p>Gracias por unirte y crear una cuenta con nosotros. Para iniciar a utilizar tu cuenta activala ingresando al siguiente enlace:</p> <a href="http://localhost/bancaUMG/activateuser.php?reference='.$reference.'">Activar Cuenta</a> </body> </html>';
        $mail->AltBody = 'Gracias por unirte a UMG-Bank solamente necesitas confirmar tu cuenta accediendo al siguiente enlace';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}