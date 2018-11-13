<?php
    session_start();
    include_once '../../inc/tools.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();

    $sql1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" .$_REQUEST["tabla"]. "';";
    $consulta1 = mysqli_query($conexion, $sql1);
    $respuesta = "";
    $respuesta = $respuesta . '<tr>';
    while ($fila1 = $consulta1->fetch_array(MYSQLI_ASSOC)){
        $respuesta = $respuesta . '<th>'. $fila1["COLUMN_NAME"] .'</th>';        
    }
    $respuesta = $respuesta . '</tr>';

    $connect->disconnectDB($conexion);
    echo $respuesta;
    
?>