<?php
session_start();
if($_REQUEST['sitio']=="exercises"){
    if($_REQUEST['tipo'] == "Operaciones")
        $_SESSION['select_t'] = "Operaciones Manipulacion de Datos";
    else
    $_SESSION['select_t'] = $_REQUEST['tipo'];
}
if($_REQUEST['sitio']=="verhoja"){
    if($_REQUEST['tipo'] == "Operaciones")
        $_SESSION['select_t_verh'] = "Operaciones Manipulacion de Datos";
    else
        $_SESSION['select_t_verh'] = $_REQUEST['tipo'];
}
?>

