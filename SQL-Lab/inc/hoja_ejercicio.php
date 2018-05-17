<?php
include_once 'functions.php';

class HojaEjercicio{

  
    function createHoja($user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into sqlab_hoja_ejercicios (user) 
        values ('".$user."');";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
   
    function deleteHoja($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM sqlab_hoja_ejercicios WHERE id_hoja=$id";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllHojas(){
    	
        $connect = new Tools();
        $conexion = $connect->connectDB();
<<<<<<< HEAD
    	$sql = "SELECT * FROM hoja_ejercicios;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllHojasDesc(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM hoja_ejercicios ORDER BY nombre_hoja DESC;";
=======
    	$sql = "SELECT nombre FROM sqlab_hoja_ejercicios;";
>>>>>>> a505122e2cdc29386511e87b36990de1f099ee2c
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getHojasById($id){

    	$sql = "SELECT * FROM sqlab_hoja_ejercicios WHERE id_hoja=$id;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

	function getHojasByUser($user){

    	$sql = "SELECT * FROM sqlab_hoja_ejercicios WHERE user=$user;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getIdByName($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
<<<<<<< HEAD
        $sql = "SELECT id_hoja FROM hoja_ejercicios WHERE id_hoja='$id';";
=======
        $sql = "SELECT id_hoja FROM sqlab_hoja_ejercicios WHERE nombre='$nombre';";
>>>>>>> a505122e2cdc29386511e87b36990de1f099ee2c
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        $res = mysqli_fetch_assoc($consulta);
        return $res;
    }
}