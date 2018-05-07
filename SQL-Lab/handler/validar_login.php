<?php 
	
	include_once '../inc/usuario.php';
	$email = $_POST["email"];
	$pass = $_POST["password"];
	$user = new Usuario();
	session_start();
	
	if( $user->getEmail($email) != null ){
		if($user->getPassword($email) == $pass){
			
			$rol = $user->getRol($email);
<<<<<<< HEAD
			$user_name = $user->getUser($email);

			$_SESSION['email'] = $email;
			$_SESSION['password'] = $pass;
			$_SESSION['rol'] = $rol;
			$_SESSION['user'] = $user_name;
=======
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $pass;
			$_SESSION['rol'] = $rol;
			$_SESSION['user'] = $user->getUser($email);
>>>>>>> 387d0a80e5f0c3583d0fbce6d4bebcce49829d1b
			
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

