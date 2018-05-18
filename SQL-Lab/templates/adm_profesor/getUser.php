<?php
include_once '../../inc/functions.php';

$connect = new Tools();
$conexion = $connect->connectDB();
$sql = "SELECT DISTINCT td.schema_prof from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.autoriza = 1";
$consulta = mysqli_query($conexion,$sql);
$i=0;
echo '<option value="0">Seleccionar</option>';
while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
	echo '<option value="'.$fila["schema_prof"].'">'.$fila["schema_prof"].'</option>';
}
$connect->disconnectDB($conexion);

?>
