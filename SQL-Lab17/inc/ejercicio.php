<?php
include_once 'functions.php';

class Ejercicio{

    public $msg;
    
    function createEjercicio($nivel,$enun,$descrip,$deshab,$tipo,$user,$sol, $tablas){
          
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $resul = "";
        $dueno = explode("_", $tablas[0], 2);

        $sql = "insert into sqlab_ejercicio (nivel,enunciado,descripcion,deshabilitar,tipo,creador_ejercicio,solucion,dueño_tablas) 
        values ('".$nivel."','".$enun."','".$descrip."','".$deshab."','".$tipo."','".$user."','".$sol."','".mb_strtolower($dueno[0])."');";
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
        $res = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $res;
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
    
    function getAllNiveles(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(nivel) FROM sqlab_ejercicio";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getAllCategorias(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT tipo FROM sqlab_categoria";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAllEjercicios(){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio ORDER BY descripcion;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    function getAllMisEjercicios($user){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_ejercicio WHERE creador_ejercicio = '$user' ORDER BY descripcion;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getDescripcionEjercicio($id){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT descripcion FROM sqlab_ejercicio WHERE id_ejercicio = '$id';";
        $consulta = mysqli_query($conexion,$sql);
        $res = mysqli_fetch_assoc($consulta);
        $connect->disconnectDB($conexion);
        return $res['descripcion'];
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
    
    function getAllEjerciciosHabilitadosAutorizados(){
        
        $sql = "SELECT sqlab_ejercicio.nivel,sqlab_ejercicio.descripcion,sqlab_ejercicio.tipo,sqlab_ejercicio.dueño_tablas FROM `sqlab_ejercicio`, `sqlab_usuario` WHERE sqlab_ejercicio.deshabilitar=0 AND sqlab_usuario.autoriza=1";
        $sql = "SELECT user FROM `sqlab_usuario` WHERE sqlab_usuario.autoriza=1 AND sqlab_usuario.rol=1 ";
    }

    function getExistEjerciciosHoja($id_h, $id_e){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COUNT(DISTINCT(ec.id_ejercicio)) as cont FROM sqlab_hoja_ejercicios as he, sqlab_esta_contenido as ec, sqlab_ejercicio as e WHERE ec.id_ejercicio = ".$id_e." AND ec.id_hoja = ".$id_h."";
        $consulta = mysqli_query($conexion,$sql);
        $row = mysqli_fetch_row($consulta);
        $connect->disconnectDB($conexion);
        return $row[0];
    }

    function getSolucionEjercicios($id) {

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT solucion FROM sqlab_ejercicio WHERE id_ejercicio = '$id';";
        $consulta = mysqli_query($conexion,$sql);
        while($fila = $consulta->fetch_assoc())
                $res=$fila['solucion'];
        $connect->disconnectDB($conexion);
        return $res;
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
            array_push($tablasDisponibles, strtolower($fila["nombre"]));
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
    function getExecuteCorrectSolucionAlumno($solucion){
        $connect = new Tools();
        $consulta = array();
        $conexion = $connect->connectDB();
        if(mysqli_query($conexion,$solucion))
                $resultado=true;
        else
            $resultado=false;
        $connect->disconnectDB($conexion);
        return $resultado;
    }
    function getRowsSolucion($solucion){
        $connect = new Tools();
        $consulta = array();
        $conexion = $connect->connectDB();
        $resultado=mysqli_query($conexion,$solucion);
        $fila = $resultado->num_rows;
        $connect->disconnectDB($conexion);
        return $fila;
    }
    function getColsSolucion($solucion){
        $connect = new Tools();
        $consulta = array();
        $conexion = $connect->connectDB();
        $resultado=mysqli_query($conexion,$solucion);
        $col = mysqli_num_fields($resultado);
        $connect->disconnectDB($conexion);
        return $col;
    }
    function executeSolucionAlumno($solucion){
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
    function compareSolucion($solucionA,$solucionP){
        $connect = new Tools();
        $consulta = array();
        $conexion = $connect->connectDB();
        $resultadoA=mysqli_query($conexion,$solucionA);
        $resultadoP=mysqli_query($conexion,$solucionP);
        if($resultadoA == $resultadoP)
            $ok = true;
        else
            $ok = false;
        $connect->disconnectDB($conexion);
        return $ok;
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
    function getAllEjerciciosAutorizadosNivelASC(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1 ORDER BY e.nivel ASC;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllEjerciciosAutorizadosNivelDESC(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1 ORDER BY e.nivel DESC;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllEjerciciosAutorizadosTipoASC(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1 ORDER BY e.tipo ASC;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllEjerciciosAutorizadosTipoDESC(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1 ORDER BY e.tipo DESC;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllEjerciciosAutorizadosCreadorASC(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1 ORDER BY e.creador_ejercicio ASC;";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    function getAllEjerciciosAutorizadosCreadorDESC(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM `sqlab_ejercicio` AS e, `sqlab_usuario` AS u WHERE e.creador_ejercicio = u.user AND u.autoriza = 1 ORDER BY e.creador_ejercicio DESC;";
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

    function enviarAviso($id){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT he.nombre_hoja, he.creador_hoja, ec.orden FROM sqlab_esta_contenido ec, sqlab_hoja_ejercicios he WHERE ec.id_hoja = he.id_hoja AND ec.id_ejercicio = $id";
        $resultado = mysqli_query($conexion,$consulta);
        while ($fila = $resultado->fetch_assoc()) {
           $user = $fila["creador_hoja"];
           $frase = "Comprueba la hoja '".$fila["nombre_hoja"]."' porque se ha modificado el ejercicio ".$fila["orden"].".";
           $consulta2 = 'INSERT INTO sqlab_avisos (nombre, mensaje, leido) VALUES ("'.$user.'", "'.$frase.'", 0);';
           $resultado2 = mysqli_query($conexion,$consulta2);
        }
        $connect->disconnectDB($conexion);

    }
   
}
