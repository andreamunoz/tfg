<?php
session_start();
if($_REQUEST['sitio']="exercises"){
    $_SESSION['select_cab'] = $_REQUEST['nameCabecera'];
    $_SESSION['value_cab'] = $_REQUEST['ordenCabecera'];
}
if($_REQUEST['sitio']="hoja"){
    $_SESSION['select_cab_h'] = $_REQUEST['nameCabecera'];
    $_SESSION['value_cab_h'] = $_REQUEST['ordenCabecera'];
}
if($_REQUEST['sitio']="verhoja"){
    $_SESSION['select_cab_verh'] = $_REQUEST['nameCabecera'];
    $_SESSION['value_cab_verh'] = $_REQUEST['ordenCabecera'];
}
?>

