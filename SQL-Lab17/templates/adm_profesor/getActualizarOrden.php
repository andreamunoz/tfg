<?php
    session_start();
    include_once '../../inc/tools.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();

    $sql = "DELETE FROM temp_".$_SESSION['user'];
    $consulta = mysqli_query($conexion, $sql);
    foreach($_REQUEST['positions'] as $pos => $valor){
        $sql3 = "INSERT INTO temp_".$_SESSION['user']."(id_ejercicio ,id_hoja,orden) values (".$_REQUEST['positions'][$pos].",".$_REQUEST['id_hoja'].",".($pos+1).");";
        $consulta3 = mysqli_query($conexion, $sql3);
    }
    $connect->disconnectDB($conexion);
    echo $consulta3;
    
?>