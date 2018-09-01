<?php
    session_start();
    include_once '../../inc/tools.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();
    $sql = "SELECT * from " .$_REQUEST["tabla"]. ";";
    $consulta = mysqli_query($conexion, $sql);

    $respuesta = "";
    while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
        $respuesta = $respuesta . '<tr>';
        foreach ($fila as $key => $value) {
            $respuesta = $respuesta . '<td>' . $value . '</td>';
        }
        $respuesta = $respuesta . '</tr>';
    }
    $connect->disconnectDB($conexion);

    echo $respuesta;

?>