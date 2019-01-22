<?php 
	session_start();
    include_once '../../inc/tools.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();

    $query1 = "DELETE FROM temp_".$_SESSION['user'];
	$resultados1 = mysqli_query($conexion, $query1);

	foreach ($_POST["value"] as $key => $value) {
		$data["Position"]=$key+1;
		updatePosition($data, $value);
	}
	var_dump("Ordenado");

	function updatePosition($data,$id){
		
		if(array_key_exists("Name", $data)){
			$data["Name"] = $this->mysql_real_escape_string($data["Name"]);
		}
		foreach ($data as $key => $value) {
			$value="'$value'";
			$updates[]="$key=$value";
		}
		$imploadArray = implode(",", $updates);
		
		$query2 = "update temp_".$_SESSION['user']."(id_ejercicio ,id_hoja,orden) values (".$_REQUEST['positions'][$pos].",".$_REQUEST['id_hoja'].",".($pos+1).");";
		$resultados2 = mysqli_query($conexion, $query2) or die(mysqli_error($con));
		if($resultados2){
			return "OK";
		}else{
			return "KO";
		}

	}















 ?>