<?php 

	include_once '../inc/usuario.php';
	$name = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$name_user = $_POST['nombre_usuario'];
	$profe_alumno = $_POST['profe_alumno'];
	if($profe_alumno == "alumno"){
		$rol = 1;
		$autoriza = 0;
	}else if($profe_alumno == "profe"){
		$rol = 0;
		if(isset($_POST['checkAutoriza'])){
			$autoriza = 1;
		}else {
			$autoriza = 0;
		}
	}
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$user = new Usuario();
	session_start();
	
	if( $user->getUser($email) == null ){
		
		$user->createUser($name,$apellidos,$name_user,$rol,$email,$pass,$autoriza);	
		$_SESSION['user'] = $name_user;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $pass;
		$_SESSION['rol'] = $rol;
		if($rol == false)
			header("Location: ../templates/index_profesor.php");
		else
			header("Location: ../templates/index_alumno.php");
	}
	else{
		header("Location: ../templates/index.php");
	}
	exit();
?>