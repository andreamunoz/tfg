<?php 
	include_once '../inc/ejercicio.php';
	session_start();
	$user = $_SESSION['user'];
        $id_ejerc = $_GET['exercise'];
	$nombre_ejerc= $_POST['edit_name_exercise'];
        $ejer = new Ejercicio();
        $exist = $ejer->getExistEjercicio($nombre_ejerc);
        $user_tabla = $_POST['user_tabla'];
        $enunciado = $_POST['enunciado'];
        $solucion = $_POST['solucion'];
        
        if($_POST['tipo'] == "Operaciones")
            $catego = "Operaciones Manipulacion de Datos";
        else 
            $catego = $_POST['tipo'];
        
        if($exist['num'] == 1){
            $ejerA = new Ejercicio();
            $resultado = $ejerA->update($id_ejerc,$nombre_ejerc, $_POST['niveles'], $catego, $_POST['habdes'], $user, $user_tabla, $enunciado, $solucion);
            if($resultado){
                    $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>El ejercicio se ha actualizado correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_exercises.php");
            }else{
                    $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>El ejercicio no se ha podido actualizado correctamente.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
                header("Location: ../templates/configuration_edit_exercises.php?exercise=$id_ejerc");
            }    
        }else {
            $ejerA = new Ejercicio();
            $resultado = $ejerA->update($id_ejerc,$nombre_ejerc, $_POST['niveles'], $catego, $_POST['habdes'], $user, $user_tabla, $enunciado, $solucion);
            if($resultado){
            $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Felicidades!</strong></h2>
                                <p>El ejercicio se ha actualizado correctamente con el nuevo nombre.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
            header("Location: ../templates/configuration_exercises.php");
                
            } else {
            $_SESSION['message_edit_sheets'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h2><strong>¡Error!</strong></h2>
                                <p>El ejercicio no se ha podido actualizado correctamente con el nuevo nombre.</p>
                            </div>
                        </div>
                    </div>   
                </div>";
            header("Location: ../templates/configuration_edit_exercises.php?exercise=$id_ejerc");
            }
        }
?>