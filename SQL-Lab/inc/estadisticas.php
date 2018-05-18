<?php
include_once 'functions.php';

class Estadisticas{

  	/********NIVEL************/
    function getStadisticNivelVeredictoTrue($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM solucion,ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.nivel = '$nivel' AND solucion.veredicto='1' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
 
    function getStadisticNivelVeredictoFalse($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM solucion,ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.nivel = '$nivel' AND solucion.veredicto='0' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    /********CATEGORIA************/

    function getStadisticTipoVeredictoTrue($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM solucion,ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.tipo = '$tipo' AND solucion.veredicto='1' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getStadisticTipoVeredictoFalse($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM solucion,ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.tipo = '$tipo' AND solucion.veredicto='0' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}