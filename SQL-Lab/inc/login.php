<?php
include_once 'functions.php';

class Login{

	function login_in($email,$pass){

        $connect = new Tools();
        $conexion = $connect->connectDB();
       	$sql = "select rol from usuario where '".$email."' = email and '".$pass."' = password";
        $consulta = mysqli_query($conexion,$sql);
        $row = mysqli_fetch_array($consulta);
        $connect->disconnectDB($conexion);
        return $row['rol'];
    }

}