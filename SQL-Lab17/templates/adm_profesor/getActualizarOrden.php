<?php
    session_start();
    include_once '../../inc/tools.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();
    $sql = "UPDATE sqlab_esta_contenido SET orden=" .$_REQUEST["positions"]. " WHERE id_hoja=".$_REQUEST["id_hoja"]." AND id_ejercicio=".$_REQUEST["id"].";";
    $consulta = mysqli_query($conexion, $sql);
    $connect->disconnectDB($conexion);
    echo $respuesta;
    
?>