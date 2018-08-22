<?php
session_start();

include_once '../inc/user.php';
$email = $_POST["email"];
$pass = $_POST["password"];
$_SESSION['msg_login'] =null;
$user = new User($email, $pass);
$result = $user->existUser($email, $pass);

if (!empty($result)) {

    $_SESSION['email'] = $user->getEmail();
    $_SESSION['password'] = $user->getPassword();
    $_SESSION['name'] = $user->getName();
    $_SESSION['apellidos'] = $user->getApellidos();
    $_SESSION['rol'] = $user->getRol();
    $_SESSION['user'] = $user->getUserName();
    $_SESSION['autoriza'] = $user->getAutoriza();
    $_SESSION['msg_congratulations']="";
    
    if ($user->getRol() == true)
        header("Location: ../templates/index.php");
    else {
        header("Location: ../templates/index.php");
    }
} else {
    $_SESSION['msg_login'] = "<div class='offset-md-3 col-md-8 mt-5 alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>¡Error!</strong> El correo electrónico o contraseña son incorrectos.
                </div>";
    header("Location: ../templates/login/login.php");
    
}
?>



