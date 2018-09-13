<?php     
    session_start();                  
    include_once '../../inc/user.php';
    
    $user = new User();
    
    if($_SESSION['modo'] == 0){
        $user->setModo(1); 
        $_SESSION['modo'] = 1;
    }else if($_SESSION['modo'] == 1){
        $user->setModo(0);
        $_SESSION['modo'] = 0;
    }
    header("Location: ../index.php");
?>