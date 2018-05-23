<?php 
	session_start();
	unset($_SESSION['editar']);

	$id = $_POST["id"];
	$_SESSION['editar'] = intval($id);
	
 ?>