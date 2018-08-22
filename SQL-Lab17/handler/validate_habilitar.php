<?php
session_start();

include_once '../inc/user.php';
include_once '../inc/ejercicio.php';
$user = $_SESSION['user'];
$_SESSION['msg_habilitar'] =null;
$id = $_GET['habilitar'];
$ejercicio = new Ejercicio();
$result = $ejercicio->setHabilitar($id);
if (!empty($result)) {
    
    $_SESSION['msg_habilitar'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>Se ha habilitado el ejercicio correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
    header("Location: ../templates/configuration_exercises.php");
} else {
    $_SESSION['msg_habilitar'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>No se ha podido Habilitar el ejercicio correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
    header("Location: ../templates/configuration_exercises.php");
    
}
?>



