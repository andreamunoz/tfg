<?php 
	session_start();
    include_once '../../inc/tools.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();

    $query1 = "CREATE TEMPORARY TABLE temp_".$_POST." SELECT * FROM sqlab_esta_contenido LIMIT 0";
	$resultados1 = mysqli_query($conexion, $query1);

	if ($resultados1){
		$resultado = true;
	}else{
		$resultado = false;
	}
		
	return $resultado;
?>