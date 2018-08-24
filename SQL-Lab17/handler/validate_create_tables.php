<?php

	include_once '../inc/administrar_schema.php';
	$code = $_POST['crea_tabla'];
	session_start();
	$_SESSION['guardarDatosTablas'] = $_POST['crea_tabla'];
	$user_name = $_SESSION['user'];
	$code = strtolower($code);
	// print_r($_SESSION);

	$admin_schema = new Administrar_schema();

	$arrayResultado = $admin_schema->obtenerSentencias($code, $user_name);
	//var_dump($arrayResultado);

	$mensaje = "";
    if(is_array($arrayResultado)){

      foreach ($arrayResultado as $key => $value) {
        if($value != ""){
          $mensaje = $mensaje.addslashes($value)." \\n";
        }else{
          $mensaje = $mensaje."Ha habido un error al ejecutar la sentencia ".$key+1 .". \\n";
        }
      }
    }else{
      $mensaje = $arrayResultado;
    }

	$_SESSION['message_table'] = "<div class='modal fade show' id='modalsheet' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <p>"+ $mensaje +"</p>
                            </div>
                        </div>
                    </div>
                </div>";
	header("Location: ../templates/configuration_tables.php");
	exit();
?>
