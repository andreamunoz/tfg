<?php
include_once 'functions.php';

class Solucion{


    function insertarSolucion($user, $id_ejercicio,$solucion, $veredicto){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $intentos = 0;
        $consulta2 = $consulta1 = false;

        $intentos=1;
        $sql1 = "INSERT INTO sqlab_resuelve(user, id_ejercicio) VALUES ('".$user."',". $id_ejercicio.");";
        $consulta1 = mysqli_query($conexion,$sql1);
        if ($consulta1){

            $sql2 = "INSERT INTO sqlab_solucion(intentos,user,id_ejercicio,fecha,veredicto,solucion_propuesta) VALUES (".$intentos.",'".$user."',".$id_ejercicio.",NOW(),".$veredicto.",'".$solucion."');";
            $consulta2 = mysqli_query($conexion,$sql2);
        }

        $connect->disconnectDB($conexion);
        return ($consulta1 and $consulta2);
    }

    function insertarOtroIntentoDeSolucion($user, $id_ejercicio,$solucion, $intentos, $veredicto){
        $connect = new Tools();
        $conexion = $connect->connectDB();

        $sql = "INSERT INTO sqlab_solucion(intentos,user,id_ejercicio,fecha,veredicto,solucion_propuesta) VALUES ('".$intentos."','".$user."','".$id_ejercicio."',NOW(),'".$veredicto."','".$solucion."');";
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

    function getAllEjerciciosByName($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_solucion WHERE id_ejercicio=$id;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getHistoricoEjercicios($id,$user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_solucion WHERE id_ejercicio=$id AND user='$user' order by fecha desc;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getSolEjerciciosByName($id,$user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_solucion WHERE id_ejercicio=$id AND user='$user' ;";
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
    
    // function getNumIntentosEjercicio($id,$user){ 
    //     $connect = new Tools();
    //     $conexion = $connect->connectDB();
    //     $sql = "SELECT MAX(intentos) AS intentos FROM sqlab_solucion WHERE id_ejercicio=$id and user='$user';";
    //     $consulta = mysqli_query($conexion,$sql);
    //     $intentos = mysqli_fetch_array($consulta);
    //     $connect->disconnectDB($conexion);
    //     return $intentos;
    // }

    function getInfoVeredictoParaTabla($id, $user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT intentos, veredicto FROM sqlab_solucion WHERE id_ejercicio = $id and user= '$user' ORDER by intentos DESC;";
        $consulta = mysqli_query($conexion,$sql);
        $intentos = mysqli_fetch_array($consulta);
        if($intentos !== NULL){
            $resul[0] = $intentos[0];
            $resul[1] = $intentos[1];
        }else{
            $resul[0] = 0;
            $resul[1] = '';
        }
        $connect->disconnectDB($conexion);
        return $resul;
    }

    function eliminarEjercicioSolucion($user,$id) {
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM `sqlab_solucion` WHERE `sqlab_solucion`.`user` = '$user' AND `sqlab_solucion`.`id_ejercicio` = $id ";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
        
    }
}