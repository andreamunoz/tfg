<?php
include_once 'functions.php';

class EstaContenido{


    function insertarEjercicioAlaHoja($id_hoja, $id_ejercicio){
    	// * cambiarlo por nombre de hoja
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $orden = "SELECT max(orden) FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja;";
        $orden = $orden + 1;
    	$sql = "INSERT INTO sqlab_esta_contenido(id_ejercicio,id_hoja,orden) VALUES ('".$id_ejercicio."','".$id_hoja."','".$orden."');";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
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

	function getAllEjerciciosByHoja($id_hoja){

        $connect = new Tools();
        $conexion = $connect->connectDB();
    	$sql = "SELECT id_ejercicio FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja;";
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

    function getNumberEjerciciosByHoja($id_hoja){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COUNT(id_ejercicio) FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja;";
        $consulta = mysqli_query($conexion,$sql);
        $count = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $count;
    }

    function getNumEjercicios($id_hoja){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COUNT(id_ejercicio) as num FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja;";
        $consulta = mysqli_query($conexion,$sql);
        $count = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $count["num"];
    }
    
    function getDeleteAllEjerciciosHoja($id_hoja){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM sqlab_esta_contenido WHERE id_hoja=$id_hoja;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getNumberEjerciciosResueltosBien($id_hoja, $user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COUNT(DISTINCT(ec.id_ejercicio)) FROM sqlab_esta_contenido as ec, sqlab_solucion as sol "
                . "WHERE ec.id_hoja = '$id_hoja' and ec.id_ejercicio = sol.id_ejercicio and veredicto='1' and user='$user'";
        $consulta = mysqli_query($conexion,$sql);
        $count = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $count;
    }
    
    function getNumberEjerciciosIntentados($id_hoja, $user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COUNT(DISTINCT(ec.id_ejercicio)) FROM sqlab_esta_contenido as ec, sqlab_solucion as sol "
                . "WHERE ec.id_hoja = '$id_hoja' and ec.id_ejercicio = sol.id_ejercicio and user='$user'";
        $consulta = mysqli_query($conexion,$sql);
        $count = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $count;
    }

    function eliminarEjercicioEstaContenido($id) {
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM `sqlab_esta_contenido` WHERE `sqlab_esta_contenido`.`id_ejercicio` = $id";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}