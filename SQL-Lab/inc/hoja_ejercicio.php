<?php
include_once 'functions.php';

class HojaEjercicio{

  
    function create($user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into hoja_ejercicios (user) 
        values ('".$user."');";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
   
    function delete($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM hoja_ejercicios WHERE id_hoja=$id";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllHojas(){
    	// * cambiarlo por nombre de hoja
    	$sql = "SELECT * FROM hoja_ejercicios;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getHojasById($id){

    	$sql = "SELECT * FROM hoja_ejercicios WHERE id_hoja=$id;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

	function getHojasByUser($user){

    	$sql = "SELECT * FROM hoja_ejercicios WHERE user=$user;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
}