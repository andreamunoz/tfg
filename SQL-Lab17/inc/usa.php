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

    function getTablasUsadas($id_ejercicio){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(nombre) FROM `sqlab_usa` WHERE id_ejercicio = $id_ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $cont = 0;
        while ($fila = $consulta->fetch_assoc()) {
            $names[$cont] = $fila["nombre"];
            $cont++;
        }
        $connect->disconnectDB($conexion);
        return $names;
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
