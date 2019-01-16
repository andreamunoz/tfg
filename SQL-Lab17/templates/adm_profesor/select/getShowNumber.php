<?php
session_start();
if($_REQUEST['sitio']="exercises"){
    $_SESSION['showNumber'] = $_REQUEST['showNumber'];
}if($_REQUEST['sitio']="hoja"){
    $_SESSION['showNumber_h'] = $_REQUEST['showNumber'];
}if($_REQUEST['sitio']="verhoja"){
    $_SESSION['showNumber_verh'] = $_REQUEST['showNumber'];
}
?>

