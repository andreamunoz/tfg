<?php
session_start();
include_once '../inc/user.php';
$email = $_POST["email"];
$pass = $_POST["password"];
$name = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$name_user = strtolower($_POST["nombre_usuario"]);
$autoriza = $_POST["checkAutoriza"];
$rol = $_POST['profe_alumno'];
$user = new User($email, $pass);
$result = $user->existUserEmail($email);
$result2 = $user->existUsername($name_user);
// var_dump($name_user);

if ($result == 0 and $result2 == 0) {
    if($rol == "alumno"){
        $rol = 1;
        $modo = 2;
        $user->setModo($modo);
    }else if($rol == "profe"){
        $rol = 0;
        $modo = 1;
        $user->setModo($modo);
    }
    if($autoriza == 1){
        $autoriza = 1;
    }
    else {
        $autoriza = 0;
    }
    $user->createUser($name, $apellidos, $name_user, $rol, $email, $pass, $autoriza);
    $_SESSION['email'] = $user->getEmail();
    $_SESSION['password'] = $user->getPassword();
    $_SESSION['rol'] = $user->getRol();
    $_SESSION['user'] = $user->getUserName();
    $_SESSION['autoriza'] = $user->getAutoriza();
    $_SESSION['name'] = $user->getName();
    $_SESSION['apellidos'] = $user->getApellidos();
    $_SESSION['modo'] = $user->getModo();
    if ($user->getRol() == false){
        $_SESSION['msg_congratulations'] = 
           "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                            </div>
                        </div>
                        <div class='modal-body'>
                            <h2><strong>¡Gracias!</strong></h2>
                            <p>Usted se ha registrado con exito.</p>
                            <p>Ahora podrás poner aprueba a tus alumnos con los ejercicios que usted o el resto de profesores suban.</p>
                        </div>
                    </div>
                </div>   
            </div>";
        header("Location: ../templates/index.php");
    }else {
        $_SESSION['msg_congratulations'] = 
           "<div class='modal fade show' id='modal-close' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' style='display:block'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <div class='close' id='close-modal'>
                                <i class='fas fa-times' data-dismiss='modal'></i>
                            </div>
                        </div>
                        <div class='modal-body'>
                            <h2><strong>¡Gracias!</strong></h2>
                            <p>Usted se ha registrado con exito.</p>
                            <p>Ahora podrás poner aprueba tus conocimientos en Base de Datos con los ejercicios que os proporcionan los profesores.</p>
                        </div>
                    </div>
                </div>   
            </div>";
        header("Location: ../templates/index.php");
    }
} else {
    $_SESSION['msg_new_register'] = "<div class='offset-md-2 col-md-9 mt-3 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> El correo electronico y/o el nombre de usuario ya existen o no son válidos.
                </div>";
    header("Location: ../templates/login/new_register.php");
}
?>





