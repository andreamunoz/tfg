<?php
session_start();
include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
if($_REQUEST["cambio"] == true){
	$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_REQUEST["dueno"]."' and u.autoriza = 1";
	$quitar = $_REQUEST["dueno"]."_";

}else if(isset($_SESSION['guardarDatos'])){
	$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_SESSION['guardarDatos'][0]."' and u.autoriza = 1";
	$quitar = $_SESSION['guardarDatos'][0]."_";
} else {
	$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_REQUEST["dueno"]."' and u.autoriza = 1";
	$quitar = $_REQUEST["dueno"]."_";
	
}

$consulta = mysqli_query($conexion,$sql);
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	$onlyName = explode($quitar, $fila["nombre"]);
	echo '<option value="'.$fila["nombre"].'">'.$onlyName[1].'</option>';
	// echo '<option value="'.$fila["nombre"].'">'.$fila["nombre"].'</option>';
}
$connect->disconnectDB($conexion);
?>