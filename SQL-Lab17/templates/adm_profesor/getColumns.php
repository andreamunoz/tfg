<?php

include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
$sql = "SHOW COLUMNS FROM ".$_REQUEST["tabla"].";";
$consulta = mysqli_query($conexion,$sql);
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
    echo '<option value="'.$fila["Field"].'">'.$fila["Field"].'</option>';
    //echo '<tr><td>'.$fila["Field"].' '.$fila["Type"].'</td></tr>';
}
$connect->disconnectDB($conexion);
?>