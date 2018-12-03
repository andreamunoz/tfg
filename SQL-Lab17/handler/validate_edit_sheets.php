<?php 
	include_once '../inc/hoja_ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
        $id_hoja = $_GET['hoja'];
	$nombre_hoja= $_POST['edit_name_sheet'];
	$seleccionados = $_POST['seleccionados'];
        
	$hoja = new HojaEjercicio();
        $exist = $hoja->getExistHoja($nombre_hoja);
        
        if($exist['num'] == 1){
            $hoja_ejer = new HojaEjercicio();
            $hoja_ejer->deleteEjerciciosDeHoja($id_hoja);
            $resultado = $hoja_ejer->updateHojaAnadirEjercicios($id_hoja, $user, $nombre_hoja, $seleccionados);
            if($resultado){
                $_SESSION['message_edit_sheets'] ="<div class='offset-md-3 col-md-8 alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Correcto!</strong> La hoja se ha actualizado correctamente.
                </div>";
            }else{
                    $_SESSION['message_edit_sheets'] = "<div class='offset-md-3 col-md-8 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> La hoja no se ha podido actualizar correctamente.
                </div>";
            }    
            header("Location: ../templates/configuration_edit_sheets.php?hoja=$id_hoja");
        }else {
            $hoja_ejer = new HojaEjercicio();
            $hoja_ejer->deleteEjerciciosDeHoja($id_hoja);
            $resultado = $hoja_ejer->updateHojaAnadirEjercicios($id_hoja, $user, $nombre_hoja, $seleccionados);
            if($resultado){
                $_SESSION['message_edit_sheets'] = "<div class='offset-md-3 col-md-8 alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Correcto!</strong> La hoja se ha creado con el nuevo nombre correctamente.
                </div>";
            } else {
                $_SESSION['message_edit_sheets'] = "<div class='offset-md-3 col-md-8 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> La hoja no se ha podido crear con el nuevo nombre correctamente.
                </div>";
            }
            header("Location: ../templates/configuration_edit_sheets.php?hoja=$id_hoja");
        }
?>