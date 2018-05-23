<?php
include_once 'functions.php';

class Estadisticas{

  	/********NIVEL************/
    function getStadisticNivelVeredictoTrue($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.nivel = '$nivel' AND solucion.veredicto='1' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
 
    function getStadisticNivelVeredictoFalse($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.nivel = '$nivel' AND solucion.veredicto='0' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    /********CATEGORIA************/

    function getStadisticTipoVeredictoTrue($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.tipo = '$tipo' AND solucion.veredicto='1' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getStadisticTipoVeredictoFalse($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion, sqlab_ejercicio WHERE ejercicio.id_ejercicio = solucion.id_ejercicio AND ejercicio.tipo = '$tipo' AND solucion.veredicto='0' AND solucion.user = '$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getPorcentajeAciertos($id_hoja){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion as s, sqlab_esta_contenido as ec WHERE ec.id_hoja=$id_hoja AND ec.id_ejercicio=s.id_ejercicio AND veredicto='1'";
        $consulta = mysqli_query($conexion,$sql);
        $res = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $res;
    }
}