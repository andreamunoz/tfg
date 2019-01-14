<?php 
        include_once '../../inc/hoja_ejercicio.php';
	session_start();
        $user = $_SESSION['user'];
        $id_hoja = $_REQUEST['hoja'];
	$seleccionados = $_REQUEST['seleccionados'];
        $hoja_ejer = new HojaEjercicio();
        $hoja_ejer->updateHojaAnadirEjercicios($id_hoja, $user, $nombre_hoja, $seleccionados);
 ?>