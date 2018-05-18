<?php

include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_REQUEST["dueno"]."' and u.autoriza = 1";
$consulta = mysqli_query($conexion,$sql);
$quitar = $_REQUEST["dueno"]."_";
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	$onlyName = explode($quitar, $fila["nombre"]);
	echo '<option value="'.$fila["nombre"].'">'.$onlyName[1].'</option>';
	// echo '<option value="'.$fila["nombre"].'">'.$fila["nombre"].'</option>';
}
$connect->disconnectDB($conexion);
?>