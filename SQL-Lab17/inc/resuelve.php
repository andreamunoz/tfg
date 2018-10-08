<?php

include_once 'functions.php';

class Resuelve{

    function eliminarEjercicioResuelve($user,$id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM `sqlab_resuelve` WHERE `sqlab_resuelve`.`user` = '$user' AND `sqlab_resuelve`.`id_ejercicio` = $id ";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}

?>