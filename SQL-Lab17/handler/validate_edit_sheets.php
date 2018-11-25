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
                header("Location: ../templates/configuration_sheets.php");
            }else{
                    $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>La hoja no se ha podido actualizar todavía en la lista.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_sheets.php");
            }    
        }else {
            $hoja_ejer = new HojaEjercicio();
            $hoja_ejer->deleteEjerciciosDeHoja($id_hoja);
            $resultado = $hoja_ejer->updateHojaAnadirEjercicios($id_hoja, $user, $nombre_hoja, $seleccionados);
            if($resultado){
                $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>La hoja se ha creado con el nuevo nombre correctamente en la lista.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
            } else {
                $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>La hoja no se ha podido crear con su nuevo nombre en la lista.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
            }
            header("Location: ../templates/configuration_sheets.php");
        }
?>