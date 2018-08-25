<?php 
	include_once '../inc/ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
	$nombre_ejerc= $_POST['new_name_exercise'];
        $ejer = new Ejercicio();
        $exist = $ejer->getExistEjercicio($nombre_ejerc);
        $user_tabla = $_POST['user_tabla'];
        $enunciado = $_POST['enunciado'];
        $solucion = $_POST['solucion'];
        if($_POST['categoria']=="Operaciones")
            $categ = "Operaciones Manipulacion de Datos";
        if($exist['num'] == 0){
            $ejerA = new Ejercicio();
            $resultado = $ejerA->createEjercicio($nombre_ejerc, $_POST['niveles'], $categ, $_POST['habdes'], $user, $user_tabla, $enunciado, $solucion);
            if($resultado){
                    $_SESSION['message_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>El ejercicio se ha creado correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_exercises.php");
            }else{
                    $_SESSION['message_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Faltan campos por rellenar en el ejercicio.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_new_exercises.php");
            }    
        }else {
            $_SESSION['message_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>Ya existe el ejercicio en la BBDD.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
            header("Location: ../templates/configuration_new_exercises.php");
        }
?>