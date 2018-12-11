<?php 
	session_start();
	unset($_SESSION["solAlum"]);
	$id_ej = $_REQUEST["id_ejercicio"];

	echo "../templates/perform_exercise.php?exercise=".$id_ej ;
?>