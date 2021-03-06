<?php

    include_once '../inc/administrar_schema.php';
    $code = $_POST['crea_tabla'];
    $_SESSION['guardarDatosTablas'] = $_POST['crea_tabla'];
    $user_name = $_SESSION['user'];

    $code = preg_replace('/\s\s+/', ' ',$code);

    $admin_schema = new Administrar_schema();
    $arrayResultado = $admin_schema->obtenerSentencias($code, $user_name);

    //var_dump($arrayResultado);
    $mensaje = "";
    if(is_array($arrayResultado)){

        foreach ($arrayResultado as $key => $value) {
            if($value != ""){
                $mensaje = $mensaje.addslashes($value)." \n";
            }else{
                $mensaje = $mensaje."Ha habido un error al ejecutar la sentencia ".$key+1 .". \n";
            }
        }
    }else{
        $mensaje = $arrayResultado;
    }

    if ($mensaje != ""){
        $_SESSION['message_new_tables'] = "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block; overflow: auto;'>
            <div class='modal-dialog modal-dialog-centered' role='document' style='max-width: 950px;'>
                <div class='modal-content' style='overflow: auto;'>
                    <div class='modal-header'>
                      <div class='close' id='close-modal'>
                        <i class='fas fa-times' data-dismiss='modal'></i>
                      </div>
                    </div>
                    <div class='modal-body' >
                        <p>". $mensaje ."</p>
                    </div>
                </div>
            </div>
        </div>";
        header("Location: ../templates/configuration_new_tables.php");
    }else{
        header("Location: ../templates/configuration_tables.php");
        
    }

    exit();
?>
