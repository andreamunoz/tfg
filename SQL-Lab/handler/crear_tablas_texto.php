<?php 
	
	include_once '../inc/administrar_schema.php';
	$code = $_POST['crea_tabla'];
	session_start();

	$user_name = $_SESSION['user'];
	$code = mb_strtolower($code);
	// print_r($_SESSION);
	
	$admin_schema = new Administrar_schema();
	
	$arrayResultado = $admin_schema->obtenerSentencias($code, $user_name);
	// var_dump($arrayResultado);
	$_SESSION['message'] = $arrayResultado; 
	//var_dump($arrayResultado);
	header("Location: ../templates/index_profesor.php");
	exit();
?>