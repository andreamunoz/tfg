<?php 
	
	include_once 'login.php';
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$connect = new Tools();
   	$conexion = $connect->connectDB();
   	$sql = "select rol from usuario where '".$email."' = email and '".$pass."' = password";
    $consulta = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($consulta);
    $connect->disconnectDB($conexion);
	if($row['rol'] == "0")
		header("Location: ../index_profesor.php");
	else if ($row['rol'] == "1")
		header("Location: ../index_alumno.php");
	else {
		header("Location: ../index.php");
	}
	exit();
?>

