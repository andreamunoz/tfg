<?php
include_once 'functions.php';

class Ejercicio{

  
    function create($nivel,$enun,$descrip,$deshab,$tipo,$user,$sol){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into ejercicio (nivel,enunciado,descripcion,deshabilitar,tipo,user,solucion) 
        values ('".$nivel."','".$enun."','".$descrip."','".$deshab."','".$tipo."','".$user."','".$sol."');";
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
   
    function delete($id){

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM ejercicio WHERE id_ejercicio=$id and deshabilitar=0;";
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

    function getAllEjercicio(){
        
        $sql = "SELECT * FROM ejercicio;";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
    
}
