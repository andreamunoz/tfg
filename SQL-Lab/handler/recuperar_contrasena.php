<?php

$to = "roberdi12@gmail.com";
$subject = "Asunto del email";
 
ini_set("sendmail_from","roberdi12@gmail.com"); 
mail($to, $subject, "hola");
//header('Location:../templates/index.php');
?>
