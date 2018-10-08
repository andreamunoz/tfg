<?php

include_once 'functions.php';

class Usa{
    
    function getNombreById($id_ejercicio){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(nombre), schema_prof FROM `sqlab_usa` WHERE id_ejercicio = $id_ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function eliminarEjerById($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM `sqlab_usa` WHERE `sqlab_usa`.`id_ejercicio` = $id";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}
