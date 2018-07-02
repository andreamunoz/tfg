<?php  

session_start();

unset($_SESSION['email']);
unset($_SESSION['user']);
unset($_SESSION['password']);
unset($_SESSION['rol']);
unset($_SESSION['lang']);
unset($_SESSION['guardarDatos']);

session_destroy();

header("Location: ../templates/index.php");

?>
 
        
