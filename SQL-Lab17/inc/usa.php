<?php

include_once 'functions.php';

class Usa{
    
    function getNombreById($id_ejercicio){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(nombre) FROM `sqlab_usa` WHERE id_ejercicio = $id_ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}
