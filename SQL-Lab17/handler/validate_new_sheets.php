<?php 
	include_once '../inc/hoja_ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
	$nombre_hoja= $_POST['new_name_sheet'];
	$seleccionados = $_POST['seleccionados'];

	$hoja = new HojaEjercicio();
        $exist = $hoja->getExistHoja($nombre_hoja);
 
        if($exist['num'] == 0){
            $hoja_ejer = new HojaEjercicio();
            $resultado = $hoja_ejer->createHojaAnadirEjercicios($user, $nombre_hoja, $seleccionados);
            if($resultado){
                    $_SESSION['message_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>La hoja se ha creado correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_sheets.php");
            }else{
                    $_SESSION['message_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Ya existe la hoja en la lista.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_new_sheets.php");
            }    
        }else {
            $_SESSION['message_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Ya existe la hoja en la lista.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
            header("Location: ../templates/configuration_new_sheets.php");
        }
?>