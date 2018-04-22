<?php 
	
	include_once '../inc/usuario.php';
	$name = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$name_user = $_POST['nombre_usuario'];
	$profe_alumno = $_POST['profe_alumno'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$user = new Usuario();
	
	if( $user->getUser($email) == null ){
		if($profe_alumno == "profe")
			$rol = 0;
		else
			$rol = 1;
		$user->createUser($name,$apellidos,$name_user,$rol,$email,$pass);	
		$_SESION['email'] = $email;
		$_SESION['password'] = $pass;
		$_SESION['rol'] = $rol;
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