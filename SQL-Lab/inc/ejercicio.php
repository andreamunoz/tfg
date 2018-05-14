<?php
include_once 'functions.php';

class Ejercicio{

  
    function createEjercicio($nivel,$enun,$descrip,$deshab,$tipo,$user,$sol, $tablas){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $resul = "";
        $sql = "insert into sqlab_ejercicio (nivel,enunciado,descripcion,deshabilitar,tipo,creador_ejercicio,solucion) 
        values ('".$nivel."','".$enun."','".$descrip."','".$deshab."','".$tipo."','".$user."','".$sol."');";
        $resul = mysqli_query($conexion,$sql);
        if(!($resul)){
            $resul = $conexion->error;
        }else{
            // $rs = mysql_insert_id();
            $rs = mysqli_query($conexion,"SELECT MAX(id_ejercicio) AS id FROM sqlab_ejercicio");
            if( $row = mysqli_fetch_row($rs)){
                $id = trim($row[0]);
                foreach ($tablas as $key => $value) {
                    $dividido = explode("_", $value, 2);
                    $sql = "insert into sqlab_usa (id_ejercicio, nombre, schema_prof) values (".$id.",'".trim($value)."','".$dividido[0]."');";
                    
                    $resul = mysqli_query($conexion,$sql);
                    if(!($resul)){ 
                        $resul = $conexion->error;
                    }
                }
            }
            
            
        }
        $connect->disconnectDB($conexion);
        return $resul;
    }
 
 	//No se utiliza en estos momentos
    function update($id,$nivel,$enun,$descrip,$deshab,$tipo,$sol){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE sqlab_ejercicio SET "
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
        $sql = "DELETE FROM sqlab_ejercicio WHERE id_ejercicio=$id and deshabilitar=0;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
   
    function getEjercicio($nombre){
       
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio WHERE nombre = '$nombre';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getEjercicioById($id){
       
        $sql = "SELECT * FROM sqlab_ejercicio WHERE id_ejercicio = '$id';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
    
    function getEjercicioByNivel($nivel){
        
        $sql = "SELECT * FROM sqlab_ejercicio WHERE nivel = '$nivel';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
   
    function getEjercicioByTipo($tipo){
       
        $sql = "SELECT * FROM sqlab_ejercicio WHERE tipo = '$tipo';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getEjercicioByUser($user){
        
        $sql = "SELECT * FROM sqlab_ejercicio WHERE user = '$user';";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getAllEjercicios(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getEjerciciosHoja($id){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_hoja_ejercicios as he, sqlab_esta_contenido as ec, sqlab_ejercicio as e WHERE ec.id_ejercicio = e.id_ejercicio AND he.id_hoja = ec.id_hoja AND he.id_hoja = '$id'";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getSolucionEjercicios($id) {

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_solucion WHERE ";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

     function getNCNEjercicio(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT nombre,tipo,nivel FROM sqlab_ejercicio;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;

    }

    function getTablasDisponibles(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT td.nombre, td.schema_prof from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.autoriza = 1";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getCategorias(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "show columns from sqlab_categoria like 'tipo'";
        $consulta = mysqli_query($conexion,$sql);
        while ($fila = $consulta->fetch_assoc()) {
            $name = $fila["Type"];
            $beginStr=strpos($name,"(")+1;
            $endStr=strpos($name,")");
            $name=substr($name,$beginStr,$endStr-$beginStr);
            $name=str_replace("'","",$name);
            $name=split(',',$name);
        }
        $connect->disconnectDB($conexion);
        return $name;
    }

    function executeSolucion($solucion){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = mysqli_query($conexion,$solucion);
        if(!$consulta){
            $consulta = $conexion->error;
        }
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
}
