<?php

include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
if ($_REQUEST["tabla"] !== ""){
	$sql = "SHOW COLUMNS FROM ".$_REQUEST["tabla"].";";
	$consulta = mysqli_query($conexion,$sql);
	while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	    //echo '<option value="'.$fila["Field"].'">'.$fila["Field"].'</option>';
	    echo '<tr><td>'.$fila["Field"].'</td><td style="padding-left: 15px">'. strtoupper($fila["Type"]).'</td></tr>';
	}
}

$connect->disconnectDB($conexion);
?>