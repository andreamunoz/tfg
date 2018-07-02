<?php
session_start();
include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
$sql = "SELECT DISTINCT td.schema_prof from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.autoriza = 1";
$consulta = mysqli_query($conexion,$sql);
$i=1;
$nombres = array();
$nombres[0] = "";
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	if(isset($_SESSION['guardarDatos'])){
		if((string)$fila["schema_prof"] !== (string)$_SESSION['guardarDatos'][0]){
			$nombres[$i] = $fila["schema_prof"];
			$i++;
		}else{
			$nombres[0] = $fila["schema_prof"];
		}
	}else{
		if((string)$fila["schema_prof"] !== (string)$_SESSION['user']){
			$nombres[$i] = $fila["schema_prof"];
			$i++;
		}else{
			$nombres[0] = $fila["schema_prof"];
		}
	}
	
}
var_dump($nombres);

if ($nombres[0] === "") {
	echo '<option value="0" selected="selected">Seleccionar</option>';
}else{
	echo '<option value="'.$nombres[0].'" selected="selected">'.$nombres[0].'</option>';
}

for($j=1; $j<(count($nombres)); $j++){

	echo '<option value="'.$nombres[$j].'">'.$nombres[$j].'</option>';
}
//echo '<option value="0">Seleccionar</option>';
// while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	// echo '<option value="'.$fila["schema_prof"].'">'.$fila["schema_prof"].'</option>';
// }
$connect->disconnectDB($conexion);

?>
