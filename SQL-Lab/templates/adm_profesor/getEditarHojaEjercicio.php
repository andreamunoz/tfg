<?php 
	session_start();
	unset($_SESSION['editar_hoja']);

	$id = $_POST["id"];
	$_SESSION['editar_hoja'] = intval($id);

	echo $_SESSION['editar_hoja'];

	
 ?>