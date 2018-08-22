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

    function getPorcentajeAciertos($id_hoja){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(veredicto) as veredicto FROM sqlab_solucion as s, sqlab_esta_contenido as ec WHERE ec.id_hoja=$id_hoja AND ec.id_ejercicio=s.id_ejercicio AND veredicto='1'";
        $consulta = mysqli_query($conexion,$sql);
        $res = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $res;
    }
    
    function getStadisticNoIntentadosNivel($nivel,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(nivel) as noIntentados FROM sqlab_solucion, sqlab_ejercicio WHERE sqlab_ejercicio.nivel = '$nivel' AND deshabilitar='0'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getStadisticIntentadosNivel($nivel, $user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(sqlab_resuelve.id_ejercicio) as intentados FROM sqlab_ejercicio, sqlab_resuelve WHERE sqlab_ejercicio.nivel='$nivel' AND sqlab_ejercicio.id_ejercicio = sqlab_resuelve.id_ejercicio AND sqlab_resuelve.id_ejercicio='$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getStadisticNoIntentadosTipo($tipo,$user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(nivel) as noIntentados FROM sqlab_solucion, sqlab_ejercicio WHERE sqlab_ejercicio.tipo = '$tipo' AND deshabilitar='0'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getStadisticIntentadosTipo($tipo, $user){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(sqlab_resuelve.id_ejercicio) as intentados FROM sqlab_ejercicio, sqlab_resuelve WHERE sqlab_ejercicio.tipo='$tipo' AND sqlab_ejercicio.id_ejercicio = sqlab_resuelve.id_ejercicio AND sqlab_resuelve.id_ejercicio='$user'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getStadisticTipo(){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT tipo FROM sqlab_categoria";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getStadisticNivel(){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT nivel FROM sqlab_ejercicio ";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}