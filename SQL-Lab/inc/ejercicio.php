<?php
include_once 'functions.php';

class Ejercicio{

  
    function createEjercicio($nombre,$nivel,$enun,$descrip,$deshab,$tipo,$user,$sol){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into ejercicio (nombre,nivel,enunciado,descripcion,deshabilitar,tipo,user,solucion) 
        values ('".$nombre."','".$nivel."','".$enun."','".$descrip."','".$deshab."','".$tipo."','".$user."','".$sol."');";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
 
 	//No se utiliza en estos momentos
    function update($id,$nivel,$enun,$descrip,$deshab,$tipo,$sol){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE ejercicio SET "
                . "nivel = '$nivel', "
                . "enunciado = '$enun', "
                . "descripcion = '$descrip', "
                . "deshabilitar = '$deshab', "
                . "tipo = '$tipo', " 
                . "solucion = '$sol'
        WHERE id_ejercicio = $id ;";
        $consulta = mysqli_query($conexion,$sql);
        if(!$consulta){
               echo "No se ha podido modificar la base de datos<br><br>".mysqli_error($conexion);
        }
        $connect->disconnectDB($conexion);
        return $consulta;
    }
   
    function deleteEjercicio($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM ejercicio WHERE id_ejercicio=$id and deshabilitar=0;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
   
    function getEjercicio($nombre){
       
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM ejercicio WHERE nombre = '$nombre';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getEjercicioById($id){
       
        $sql = "SELECT * FROM ejercicio WHERE id_ejercicio = '$id';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
    
    function getEjercicioByNivel($nivel){
        
        $sql = "SELECT * FROM ejercicio WHERE nivel = '$nivel';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
   
    function getEjercicioByTipo($tipo){
       
        $sql = "SELECT * FROM ejercicio WHERE tipo = '$tipo';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getEjercicioByUser($user){
        
        $sql = "SELECT * FROM ejercicio WHERE user = '$user';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getAllEjercicios(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getEjerciciosHoja($id){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM hoja_ejercicios as he, esta_contenido as ec, ejercicio as e WHERE ec.id_ejercicio = e.id_ejercicio AND he.id_hoja = ec.id_hoja AND he.id_hoja = '$id'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getSolucionEjercicios($id) {

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM solucion WHERE ";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

     function getNCNEjercicio(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT nombre,tipo,nivel FROM ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;

    }
    
}
