<?php
session_start();
if($_REQUEST['grafico']=="barra")
    $_SESSION['grafico'] = "barra";
else if($_REQUEST['grafico']=="circular")
    $_SESSION['grafico'] = "circular";
?>

