<?php 
	
	include_once '../inc/administrar_schema.php';
	$code = $_POST['crea_tabla'];
	session_start();

	$user_name = $_SESSION['user'];
	$code = strtolower($code);
	// print_r($_SESSION);
	
	$admin_schema = new Administrar_schema();
	
	$arrayResultado = $admin_schema->obtenerSentencias($code, $user_name);
	//var_dump($arrayResultado);
	$_SESSION['message'] = $arrayResultado; 
	header("Location: ../templates/prf_tablas.php");
	exit();
?>