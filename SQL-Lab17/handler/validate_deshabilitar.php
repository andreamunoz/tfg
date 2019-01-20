<?php
session_start();

include_once '../inc/user.php';
include_once '../inc/ejercicio.php';
$user = $_SESSION['user'];
$_SESSION['msg_habilitar'] =null;
$id = $_GET['deshabilitar'];
$ejercicio = new Ejercicio();
$result = $ejercicio->setDesHabilitar($id);
if (!empty($result)) {
    
    $_SESSION['msg_habilitar'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <p>Se ha deshabilitado el ejercicio correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
    header("Location: ../templates/configuration_exercises.php");
} else {
    $_SESSION['msg_habilitar'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>No se ha podido deshabilitar el ejercicio correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
    header("Location: ../templates/configuration_exercises.php");
    
}
?>



