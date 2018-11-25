<?php
session_start();

include_once '../inc/user.php';
include_once '../inc/hoja_ejercicio.php';
include_once '../inc/esta_contenido.php';

$user = $_SESSION['user'];
$_SESSION['msg_eleminar_hoja'] =null;
$id = $_GET['eliminar_hoja'];
$hoja = new HojaEjercicio();
$ejer = new EstaContenido();
$res = $ejer->getDeleteAllEjerciciosHoja($id);
$result = $hoja->deleteHoja($id);
if (!empty($result)) {
    
    $_SESSION['msg_eleminar_hoja'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>Se ha eliminado la hoja correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
    header("Location: ../templates/configuration_sheets.php");
} else {
    $_SESSION['msg_eleminar_hoja'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                              </div>
                            </div>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>No se ha eliminado la hoja correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
    header("Location: ../templates/configuration_sheets.php");
    
}
?>



