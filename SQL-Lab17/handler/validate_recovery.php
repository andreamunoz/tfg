<?php

session_start();

require("../mailer/class.phpmailer.php");
require("../mailer/class.smtp.php");
include_once '../inc/user.php';
$to = $_POST['recover-email'];
$_SESSION['msg_recover'] = null;
$user = new User();
$result = $user->existEmail($to);

if ($result != '') {

    $userName = $user->getNombreUsuario($to);
    $psswd = substr(md5(microtime()), 1, 8);
    $_SESSION['emailNewPass'] = $to;
    $_SESSION['passwd'] = $psswd;
    $mensaje = "<html>
    <head>
        <meta charset='UTF-8'>
    </head>
    <body style='background:#e8e8e8;'>
    	<div>
            <table width='0' cellspacing='0' cellpadding='10' border='0' align='center'>
                <thead>
                    <tr>
                        <td width='600' style='text-align:center; padding: 21px; font-size: 25px;'>
                            <a href='http://chusky.fdi.ucm.es/~tfg17sql/SQL-Lab17/templates/login/login.php' style='margin: 10px; color: gray;'>SQLab</a>
                        </td>
                    </tr>
                </thead>
                <tbody style='background: white'>
                    <tr>
                        <td width='600' style='font-size: 15px; border-top: 6px solid gray;'>
                            <h1 style='text-align:center;'>Hola, Roberto Díaz Gómez!</h1>
                            <p style='padding-top: 25px; padding-left: 25px;'>Ha solicitado restablecer la contraseña de SQLab, sigue los siguientes pasos:</p>
                            <p style='padding-left: 50px;'>1. Copie el siguiente código de seguridad <strong>$psswd</strong></p>
                            <p style='padding-bottom: 25px; padding-left: 50px;'>2. Pinche en el siguiente enlace para acceder a cambiar la contraseña <a style='text-align:center; color: gray' href='http://localhost/tfg/SQL-Lab17/templates/login/change_password.php'>Restablecer contraseña</a></p>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td width='600'>
                            <p style='font-size: 15px; color: gray'>Este mensaje ha sido enviado a $to por un sistema automático. Por favor no respondas a este correo electrónico. Tienes 30 minutos para cambiar la contraseña con este código,
                                de lo contrario tendrá que realiza otra vez la misma operación.</p>
                        </td>
                    </tr>
                </tfoot>
            </table>
    	</div>	
    </body>
    </html>";
    
    // Datos de la cuenta de correo utilizada para enviar v�a SMTP
    $smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
    $smtpUsuario = "sqlab17@gmail.com";  // Mi cuenta de correo
    $smtpClave = "SQLab_17";  // Mi contrase�a

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";
    $mail->SMTPSecure = 'ssl';
    // VALORES A MODIFICAR //
    $mail->Host = $smtpHost;
    $mail->Username = $smtpUsuario;
    $mail->Password = $smtpClave;
    $mail->From = $smtpUsuario; // Email desde donde envio el correo.
    $mail->FromName = $userName;
    $mail->addAddress($to); // Esta es la dirección a donde enviamos los datos del formulario
    $mail->Subject = 'Recuperación de contraseña'; // Este es el titulo del email.
    //$mensajeHtml = nl2br($mensaje);
    $mail->Body = "<html>
    <head>
        <meta charset='UTF-8'>
    </head>
    <body style='background:#e8e8e8;'>
    	<div>
            <table width='0' cellspacing='0' cellpadding='10' border='0' align='center'>
                <thead>
                    <tr>
                        <td width='600' style='text-align:center; padding: 21px; font-size: 25px;'>
                            <a href='http://chusky.fdi.ucm.es/~tfg17sql/SQL-Lab17/templates/login/login.php' style='margin: 10px; color: gray;'>SQLab</a>
                        </td>
                    </tr>
                </thead>
                <tbody style='background: white'>
                    <tr>
                        <td width='600' style='font-size: 15px; border-top: 6px solid gray;'>
                            <h1 style='text-align:center;'>Hola, Roberto Díaz Gómez!</h1>
                            <p style='padding-top: 25px; padding-left: 25px;'>Ha solicitado restablecer la contraseña de SQLab, sigue los siguientes pasos:</p>
                            <p style='padding-left: 50px;'>1. Copie el siguiente código de seguridad <strong>$psswd</strong></p>
                            <p style='padding-bottom: 25px; padding-left: 50px;'>2. Pinche en el siguiente enlace para acceder a cambiar la contraseña <a style='text-align:center; color: gray' href='http://chusky.fdi.ucm.es/~tfg17sql/SQL-Lab17/templates/login/change_password.php'>Restablecer contraseña</a></p>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td width='600'>
                            <p style='font-size: 15px; color: gray'>Este mensaje ha sido enviado a $to por un sistema automático. Por favor no respondas a este correo electrónico. Tienes 30 minutos para cambiar la contraseña con este código,
                                de lo contrario tendrá que realiza otra vez la misma operación.</p>
                        </td>
                    </tr>
                </tfoot>
            </table>
    	</div>	
    </body>
    </html>";
    // Texto del email en formato HTML
    $mail->AltBody = ''; // Texto sin formato HTML
    // FIN - VALORES A MODIFICAR //
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
   
    $estadoEnvio = $mail->Send();
    if ($estadoEnvio) {
        $_SESSION['msg_recover'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Todo ha ido bien!</strong> Recibirá un correo electrónico para poder cambiar la contraseña.
                </div>";
        header("Location: ../templates/login/recover_password.php");
    } else {
        $_SESSION['msg_recover'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> El correo electrónico no se ha podido enviar.
                </div>";
        header("Location: ../templates/login/recover_password.php");
    }
} else {
    $_SESSION['msg_recover'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> El correo electrónico no existe.
                </div>";
    header("Location: ../templates/login/recover_password.php");
}


?>