<?php
include_once 'functions.php';

class Ejercicio{

  
    function createEjercicio($nivel,$enun,$descrip,$deshab,$tipo,$user,$sol, $tablas){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $resul = "";
        $dueño = explode("_", $tablas[0], 2);

        $sql = "insert into sqlab_ejercicio (nivel,enunciado,descripcion,deshabilitar,tipo,creador_ejercicio,solucion,dueño_tablas) 
        values ('".$nivel."','".$enun."','".$descrip."','".$deshab."','".$tipo."','".$user."','".$sol."','".strtolower($dueño[0])."');";
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
 
    function update($id,$nivel,$enun,$descrip,$deshab,$tipo,$sol,$user){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE sqlab_ejercicio SET nivel = '$nivel', enunciado = '$enun', descripcion = '$descrip', deshabilitar = '$deshab', tipo = '$tipo', solucion = '$sol' WHERE id_ejercicio = $id;";
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
        $sql = "DELETE FROM `sqlab_usa` WHERE id_ejercicio = $id;";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){;
            $sql2 = "DELETE FROM sqlab_ejercicio WHERE id_ejercicio=$id;";
            $consulta2 = mysqli_query($conexion,$sql2);
        }
        $connect->disconnectDB($conexion);
        return ($consulta && $consulta2);
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
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio WHERE id_ejercicio = '$id';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
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

     function getAllEjerciciosHabilitados(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio WHERE deshabilitar='0';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllEjerciciosDesHabilitados(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio WHERE deshabilitar='1';";
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

    function getTodasTablas(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT td.nombre from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.autoriza = 1";
        $consulta = mysqli_query($conexion,$sql);
        $tablasDisponibles = array();
        while ($fila = $consulta->fetch_assoc()) {
            array_push($tablasDisponibles, $fila["nombre"]);
        }
        $connect->disconnectDB($conexion);
        return $tablasDisponibles;
    }

    function getUserTablasDisponibles($user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT td.schema_prof from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.autoriza = 1";
        $consulta = mysqli_query($conexion,$sql);
        $usuarios = array();
        $i = 1;
        while ($fila = $consulta->fetch_assoc()) {
            if($fila["schema_prof"] === $user){
                $usuarios[0]=$user;
            }else{
                $usuarios[$i] = $fila["schema_prof"];
                $i++;
            }
        }
        $connect->disconnectDB($conexion);
        return $usuarios;
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
        $consulta = array();
        $conexion = $connect->connectDB();
        $resultado = mysqli_query($conexion,$solucion);
        if(!$resultado){
            $consulta[0] = false;
            $consulta[1] = $conexion->error;
        }else{
            $consulta[0] = $resultado;
        }
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function executeSolucionNoSelect($solucion){
        $connect = new Tools();
        $consulta = array();
        $conexion = $connect->connectDB();
        $conexion->autocommit(FALSE);

        $conexion->begin_transaction();
        $resultado = mysqli_query($conexion,$solucion);
        if(!$resultado){
            $consulta[0] = false;
            $consulta[1] = $conexion->error;
        }else{
            $consulta[0] = $resultado;
        }
        $conexion->rollback();
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getTablasUsa($id){

        $sql = "SELECT nombre FROM `sqlab_usa` WHERE id_ejercicio =".$id.";";
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
    
    function setDeshabilitar($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE `sqlab_ejercicio` SET `deshabilitar`= 1 WHERE `id_ejercicio` = $id;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function setHabilitar($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE `sqlab_ejercicio` SET `deshabilitar`= 0 WHERE `id_ejercicio` = $id;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllEjerciciosAutorizados(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function comprobarSiEstaUsada($tabla){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT count(id_ejercicio) as c from  sqlab_usa WHERE nombre='$tabla';";
        $consulta = mysqli_query($conexion,$sql);
        foreach ($consulta as $key => $value) {
            $resultado = intval($value["c"]);
        }
        $connect->disconnectDB($conexion);
        return $resultado;
    }
}
