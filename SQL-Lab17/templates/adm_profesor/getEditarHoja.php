<?php 
        include_once '../../inc/hoja_ejercicio.php';
	session_start();
        $user = $_SESSION['user'];
        $id_hoja = $_REQUEST['hoja'];
	$nombre_hoja = $_REQUEST['name'];
	$seleccionados = $_REQUEST['seleccionados'];
        
        $hoja_ejer = new HojaEjercicio();
        $resultado = $hoja_ejer->updateHojaAnadirEjercicios($id_hoja, $user, $nombre_hoja, $seleccionados);
        if(!$resultado){
                $_SESSION['message_edit_sheets'] = "<div class='offset-md-3 col-md-8 alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>¡Error!</strong> La hoja no se ha podido actualizar correctamente.
            </div>";
        }    
        
 ?>