<?php
session_start();
include ("../inc/ejercicio.php");
$ejer = new Ejercicio();
//Comprobar la ejecucion del alumno
$id = $_GET['exercise'];
$solucion_alumno = $_POST['sol_ejercicio'];
$ejecutable = $ejer->getExecuteCorrectSolucionAlumno($solucion_alumno);
//Si la ejecucion es correcta 
if ($ejecutable == true) {
    //Comparar string
    $solucion_profesor = $ejer->getSolucionEjercicios($id);
    if (strcasecmp($solucion_alumno, $solucion_profesor) == 0) {
        $_SESSION['msg_solucion'] = "<div class=''><h1>El ejercicio se ha completado correctamente<h1></div>";
        header("Location: ../templates/perform_exercise.php?exercise=" . $id);
    } else {
        $rowsA = $ejer->getRowsSolucion($solucion_alumno);
        $rowsP = $ejer->getRowsSolucion($solucion_profesor);
      
        if ($rowsA == $rowsP) {
            $colA = $ejer->getColsSolucion($solucion_alumno);
            $colP = $ejer->getColsSolucion($solucion_profesor);
            if ($colA === $colP) {
                $ok=$ejer->compareSolucion($solucion_profesor,$solucion_alumno);
                if($ok == true){
                    $_SESSION['msg_solucion'] = 
                    "<div class='modal fade show' id='modalsolucion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                        <div class='modal-dialog modal-dialog-centered' role='document'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <h2><strong>¡Felicidades!</strong></h2>
                                    <p>El ejercicio esta resuelto correctamente.</p>
                                </div>
                            </div>
                        </div>   
                    </div>";
                    header("Location: ../templates/perform_exercise.php?exercise=" . $id."&all=true");
                }
                else{
                    $_SESSION['msg_solucion'] = 
                    "<div class='modal fade show' id='modalsolucion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                        <div class='modal-dialog modal-dialog-centered' role='document'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <h2><strong>¡Error!</strong></h2>
                                    <p>El .</p>
                                    <p>El ejercicio ya CASI está.</p>
                                </div>
                            </div>
                        </div>   
                    </div>";
                    header("Location: ../templates/perform_exercise.php?exercise=" . $id."&yet=false");
                }
            }else{
                $_SESSION['msg_solucion'] = 
                "<div class='modal fade show' id='modalsolucion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Columnas de la consulta INCORRECTAS.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/perform_exercise.php?exercise=" . $id."&col=false");
            }
        } else {
             $_SESSION['msg_solucion'] = 
            "<div class='modal fade show' id='modalsolucion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <h2><strong>¡Error!</strong></h2>
                            <p>Filas de la consulta INCORRECTAS.</p>
                        </div>
                    </div>
                </div>   
            </div>";
             header("Location: ../templates/perform_exercise.php?exercise=" . $id."&row=false");
        }
    }
} else {
    $_SESSION['msg_solucion'] = 
            "<div class='modal fade show' id='modalsolucion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <h2><strong>¡Error!</strong></h2>
                            <p>El ejercicio es INCORRECTO.</p>
                        </div>
                    </div>
                </div>   
            </div>";
    header("Location: ../templates/perform_exercise.php?exercise=" . $id."&all=false");
}
?>