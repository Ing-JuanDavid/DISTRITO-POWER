<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__."/../libs/PHPMailer/Exception.php";
require_once __DIR__.'/../libs/PHPMailer/PHPMailer.php';
require_once __DIR__.'/../libs/PHPMailer/SMTP.php';

class Mailer {
    
    public static function sendMail($email, $name, $subj, $msj) {
        $mail = new PHPMailer(true);
            //Credentials
            $credentials = require_once __DIR__."/../config/credentials.php";    

            // Config SMTP
            //$mail->SMTPDebug = 2; // Niveles de depuración: 1 para errores, 2 para información detallada
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $credentials["SMTP_HOST"];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $credentials["SMTP_USER"];                     //SMTP username
            $mail->Password   = $credentials["SMTP_PASS"];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port = $credentials["SMTP_PORT"];    
        
            // Correo 
            $mail->setFrom('juandavidsalgadoromero564@gmail.com', 'Soft');
            // Destinatario
            $mail->addAddress($email, $name);

            // Contenido
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subj;
            $mail->Body    = $msj;       
            $mail->send();
    }
}


