<?php 
	
	include_once '../inc/usuario.php';
	$email = $_POST["email"];
	$pass = $_POST["password"];
	$user = new Usuario();
	
	if( $user->getEmail($email) != null ){
		if($user->getPassword($email) == $pass){
			
			$rol = $user->getRol($email);
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $pass;
			$_SESSION['rol'] = $rol;
			$_SESSION['user'] = $user->getUser($email);
			
			if($rol == false)
				header("Location: ../templates/index_profesor.php");
			else{
				header("Location: ../templates/index_alumno.php");
			}
		}
		else{
			header("Location: ../templates/index.php");
		}
	}
	else{
		header("Location: ../templates/index.php");
	}
	exit();
?>

