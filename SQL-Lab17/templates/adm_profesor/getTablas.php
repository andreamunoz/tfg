<?php
session_start();
include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
if($_REQUEST["cambio"] == true){
	$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_REQUEST["dueno"]."';";
	$quitar = $_REQUEST["dueno"]."_";

}else if(isset($_SESSION['guardarDatos'])){
	$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_SESSION['guardarDatos'][0]."';";
	$quitar = $_SESSION['guardarDatos'][0]."_";
} else {
	$sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and td.schema_prof = '".$_REQUEST["dueno"]."';";
	$quitar = $_REQUEST["dueno"]."_";
	
}

$consulta = mysqli_query($conexion,$sql);
echo '<option value="">Selecciona Tabla</option>';
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	$onlyName = explode($quitar, $fila["nombre"]);
        if($_SESSION['perform_tabla']==$onlyName[1]){
            echo '<option value="'.$fila["nombre"].'">'.$onlyName[1].'</option>';
        }else{
            echo '<option value="'.$fila["nombre"].'">'.$onlyName[1].'</option>';
        }
}
$connect->disconnectDB($conexion);
?>