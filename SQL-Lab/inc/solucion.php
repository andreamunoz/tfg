<?php
include_once 'functions.php';

class Solucion{


    function insertarSolucionAlEjercicio($user, $id_ejercicio,$fecha,$solucion){
    	// * cambiarlo por nombre de hoja
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $veredicto=0;
        //cambiar consulta (mirar en libretita);
        //consulta para saber si existe un ejercicio concreto
        $sql_intentos = "SELECT intentos FROM sqlab_solucion WHERE id_ejercicio=$id_ejercicio and user=$user";
        if($ql_intentos <> NULL){
        	$intentos = ".$sql_intentos." + 1;
        	$sql="UPDATE sqlab_solucion SET "
                . "nivel = '$nivel', ";
        }
        else{
        	$intentos=1;
	    	$sql = "INSERT INTO sqlab_esta_contenido(intentos,user,id_ejercicio,fecha,veredicto,solucion_propuesta) VALUES ('".$intentos."','".$user."','".$id_ejercicio."','".$id_ejercicio."','".$fecha."','".$veredicto."','".$solucion_propuesta."');";
	        $consulta = mysqli_query($conexion,$sql);
	        $connect->disconnectDB($conexion);
	    }
        return $consulta;
    }

    function eliminarEjercicioDeLaHoja($id_hoja, $id_ejercicio){

        $connect = new Tools();
        $conexion = $connect->connectDB();
    	$sql = "DELETE FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja and id_ejercicio=$id_ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllEjerciciosByName($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_solucion WHERE id_ejercicio=$id;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

	function getAllEjerciciosByHoja($id_hoja){

        $connect = new Tools();
        $conexion = $connect->connectDB();
    	$sql = "DELETE FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getEjerciciosNoHoja($id_hoja){

        $sql = "SELECT * FROM sqlab_esta_contenido WHERE id_hoja<>$id_hoja;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }


    function getHojaEstadisticas(){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion WHERE veredicto='1';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getCuantosEjerciciosByName($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COUNT(id_ejercicio) AS cantidad FROM sqlab_solucion WHERE id_ejercicio=$id;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

}