<?php 
        include_once '../../inc/hoja_ejercicio.php';
	session_start();
        $user = $_SESSION['user'];
	$nombre_hoja = $_REQUEST['name'];
	$seleccionados = $_REQUEST['seleccionados'];
        
        $hoja_ejer = new HojaEjercicio();
        $resultado = $hoja_ejer->createHojaAnadirEjercicios($user, $nombre_hoja, $seleccionados);
        if(!$resultado){
                $_SESSION['message_new_sheets'] = "<div class='col-md-8 alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>¡Error!</strong> La hoja no se ha podido crear correctamente.
            </div>";
        }    
        
 ?>