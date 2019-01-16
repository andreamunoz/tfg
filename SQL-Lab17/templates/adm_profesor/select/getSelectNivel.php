<?php
session_start();
if($_REQUEST['sitio']=="exercises")
    $_SESSION['select_n'] = $_REQUEST['nivel'];
if($_REQUEST['sitio']=="verhoja")
    $_SESSION['select_n_verh'] = $_REQUEST['nivel'];
?>

