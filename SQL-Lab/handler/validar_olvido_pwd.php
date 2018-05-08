<?php 
	
	include_once '../inc/usuario.php';
	include_once '../templates/mail/PHPMailerAutoload.php';

	require('../templates/mail/PHPMailerAutoload.php');
	$mail = new PHPMailer;

	$email = $_POST["email"];

	$user = new Usuario();
	session_start();
	
	if( $user->getEmail($email) != null ){

		$pass = $user->getPassword($email);
		$mail->setFrom('Administradores de SQL-Lab');	
		$mail->addAddress($email);
		$mail->Subject = 'Recuperar contraseña';
		$mail->isHTML(true);
		$mail->Body = "Esta es su contraseña " . $password." Un saludo.";


		/*$to = $email;
		$subject = "Recuperar contraseña";
 
		$message = "Esta es su contraseña " . $password;
		$headers = "De : Administradores de SQL-Lab";
		if(mail($to, $subject, $message, $headers)){
			echo "Te hemos enviado un email con la contraseña";
		}else{
			echo "Algo falló al recuperar la contraseña, inténtalo de nuevo.";
		}*/	

	}
	else{
		header("Location: ../templates/index.php");
	}
	exit();
?>

