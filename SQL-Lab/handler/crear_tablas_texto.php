<?php 
	
	include_once '../inc/administrar_schema.php';
	$code = $_POST['crea_tabla'];
	session_start();

	$user_name = $_SESSION['user'];
	
	// print_r($_SESSION);
	
	$admin_schema = new Administrar_schema();
	
	$arrayResultado = $admin_schema->obtenerSentencias($code, $user_name);
	header("Location: ../templates/index_profesor.php");
	//var_dump($arrayResultado);
	exit();
?>