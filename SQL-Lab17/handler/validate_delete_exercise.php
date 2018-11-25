<?php
session_start();

include_once '../inc/solucion.php';
include_once '../inc/resuelve.php';
include_once '../inc/usa.php';
include_once '../inc/esta_contenido.php';
include_once '../inc/ejercicio.php';

$user = $_SESSION['user'];
$_SESSION['msg_habilitar'] = null;
$id = $_GET['eliminar'];

//Borrado de la Tabla Solucion
$solucionId = new Solucion();
$borrado = $solucionId->eliminarEjercicioSolucion($user, $id);
if ($borrado) {
    //Borrado de la Tabla Resuelve
    $resuelve = new Resuelve();
    $ok = $resuelve->eliminarEjercicioResuelve($user, $id);
    if ($ok) {
        //Borrado de la Tabla Usa
        $usaId = new Usa();
        $exito = $usaId->eliminarEjerById($id);
        if ($exito) {
            //Borrado de la Tabla EstaContenido
            $idEstaContenido = new EstaContenido();
            $esta = $idEstaContenido->eliminarEjercicioEstaContenido($id);
            if ($esta) {
                //Borrado de la Tabla Ejercicio
                $ejercicio = new Ejercicio();
                $result = $ejercicio->eliminarEjercicio($id);
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
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>Se ha habilitado el ejercicio correctamente.</p>
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
                                <p>No se ha podido Habilitar el ejercicio correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                    header("Location: ../templates/configuration_exercises.php");
                }
            }
        }
    }
                
}

?>




