<?php
session_start();
include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();

if ( isset($_REQUEST["prof"])){
	$sql = "SELECT DISTINCT td.schema_prof, u.nombre, u.apellidos from sqlab_tablas_disponibles as td, sqlab_usuario as u where (td.schema_prof = u.user and u.autoriza = 1) or (td.schema_prof = u.user and u.user = '".$_REQUEST["prof"]."'); ";
} else{
	$sql = "SELECT DISTINCT td.schema_prof, u.nombre, u.apellidos from sqlab_tablas_disponibles as td, sqlab_usuario as u where (td.schema_prof = u.user and u.autoriza = 1) or (td.schema_prof = u.user); ";
}
$consulta = mysqli_query($conexion,$sql);
$i=1;
$nombres = array();
$nombreCompleto = array();
$nombres[0] = "";
$nombreCompleto[0] = "";
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	if(isset($_SESSION['guardarDatos'])){
		if((string)$fila["schema_prof"] !== (string)$_SESSION['guardarDatos'][0]){
			$nombres[$i] = $fila["schema_prof"];
			$nombreCompleto[$i] = $fila["nombre"].' '.$fila["apellidos"];
			$i++;
		}else{
			$nombres[0] = $fila["schema_prof"];
			$nombreCompleto[0] = $fila["nombre"].' '.$fila["apellidos"];
		}
	}else{
		if((string)$fila["schema_prof"] !== (string)$_SESSION['user']){
			$nombres[$i] = $fila["schema_prof"];
			$nombreCompleto[$i] = $fila["nombre"].' '.$fila["apellidos"];
			$i++;
		}else{
			$nombres[0] = $fila["schema_prof"];
			$nombreCompleto[0] = $fila["nombre"].' '.$fila["apellidos"];
		}
	}
	
}
// var_dump($nombres);

if ($nombres[0] === "") {
	echo '<option value="0" selected="selected">Seleccionar</option>';
}else{
	echo '<option value="'.$nombres[0].'" selected="selected">'.$nombreCompleto[0].'</option>';
}

for($j=1; $j<(count($nombres)); $j++){

	echo '<option value="'.$nombres[$j].'">'.$nombreCompleto[$j].'</option>';
}
//echo '<option value="0">Seleccionar</option>';
// while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	// echo '<option value="'.$fila["schema_prof"].'">'.$fila["schema_prof"].'</option>';
// }
$connect->disconnectDB($conexion);

?>
