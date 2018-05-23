<?php
include_once 'functions.php';

class Estadisticas{

  	/********NIVEL************/
    function getStadisticNivelVeredictoTrue($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE sqlab_ejercicio.id_ejercicio = sqlab_solucion.id_ejercicio AND sqlab_ejercicio.nivel = '$nivel' AND sqlab_solucion.veredicto='1' AND sqlab_solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
 
    function getStadisticNivelVeredictoFalse($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE sqlab_ejercicio.id_ejercicio = sqlab_solucion.id_ejercicio AND sqlab_ejercicio.nivel = '$nivel' AND sqlab_solucion.veredicto='0' AND sqlab_solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    /********CATEGORIA************/

    function getStadisticTipoVeredictoTrue($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE sqlab_ejercicio.id_ejercicio = sqlab_solucion.id_ejercicio AND sqlab_ejercicio.tipo = '$tipo' AND sqlab_solucion.veredicto='1' AND sqlab_solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getStadisticTipoVeredictoFalse($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE sqlab_ejercicio.id_ejercicio = sqlab_solucion.id_ejercicio AND sqlab_ejercicio.tipo = '$tipo' AND sqlab_solucion.veredicto='0' AND sqlab_solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}