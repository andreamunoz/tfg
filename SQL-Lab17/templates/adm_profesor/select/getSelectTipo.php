<?php
session_start();
if($_REQUEST['tipo'] == "Operaciones")
    $_SESSION['select_t'] = "Operaciones Manipulacion de Datos";
else
    $_SESSION['select_t'] = $_REQUEST['tipo'];
?>

