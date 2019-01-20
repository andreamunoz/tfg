<?php
session_start();
include_once '../inc/user.php';

if(isset($_POST["editar"])){
    $user = new User();
    $email = $_SESSION["email"];
    $name = $_POST["edit_nombre"];
    $apellidos = $_POST["edit_apellidos"];
    //$userName = $_POST["edit_nombre_usuario"];
    $autoriza = $_POST["check"];
    $asociado = $_POST["asociado_profesor"];
    $result = $user->updateUser($email, $name, $apellidos, $autoriza, $asociado);
    if($result){
        $_SESSION['autoriza'] = $user->getAutoriza();
        $_SESSION['name'] = $user->getName();
        $_SESSION['apellidos'] = $user->getApellidos();
        $_SESSION['asociado'] = $asociado;
        
        $_SESSION['msg_update_register'] = "<div class='col-md-12 mt-5 alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    El perfil se ha podido actualizar correctamente.
                </div>";
        header("Location: ../templates/edit_profile.php");
    }
    else{
        $_SESSION['msg_update_register'] = "<div class='col-md-12 mt-5 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> El perfil no se ha podido actualizar correctamente.
                </div>";
        header("Location: ../templates/edit_profile.php");
    }
}
   
?>





