<?php
session_start();
if($_REQUEST['sitio']=="exercises")
    $_SESSION['select_p'] = $_REQUEST['name'];
if($_REQUEST['sitio']=='hoja')
    $_SESSION['select_p_h'] = $_REQUEST['name'];
if($_REQUEST['sitio']=='verhoja')
    $_SESSION['select_p_verh'] = $_REQUEST['name'];
?>

