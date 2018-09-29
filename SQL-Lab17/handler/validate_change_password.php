<?php

session_start();
include_once '../inc/user.php';
$code = $_POST['code'];
$newPass = $_POST['new_password'];
$newPass2 = $_POST['new_password2'];
$email = $_SESSION['emailNewPass'];
$_SESSION['msg_change'] = null;

if ($_SESSION['passwd'] == $code) {
    if ($newPass == $newPass2) {
        $user = new User();
        if($user->getChangePassword($email, $newPass)){
            $_SESSION['msg_change'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>¡Nueva contraseña cambiada!</strong>.
                    </div>";
            header("Location: ../templates/login/login.php");
        }else{
            $_SESSION['msg_change'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>¡Error! No se ha podido cambiar la conraseña</strong>.
                    </div>";
            header("Location: ../templates/login/login.php");
        }
    } else {
        $_SESSION['msg_change'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> Las contraseñas no coinciden .
                </div>";
        header("Location: ../templates/login/change_password.php");
    }
} else {
    if($_SESSION['passwd'] == ''){
        $_SESSION['msg_change'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>¡Error!</strong> El código ha expirado, inténtelo de nuevo.
                    </div>";
        header("Location: ../templates/login/recover_password.php");
    }else {
        $_SESSION['msg_change'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>¡Error!</strong> El código es incorrecto, inténtelo de nuevo.
                    </div>";
        header("Location: ../templates/login/change_password.php");
    }
}
?>

