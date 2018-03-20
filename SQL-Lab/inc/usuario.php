<?php
include_once 'functions.php';

class Usuario{

    public $ID = 0;
    /**
     * Crea una nueva fila en la tabla table1.
     * @param type $name
     * @param type $name_twitter
     * @param type $fecha_inicio
     * @param type $fecha_final
     * @return type
     */
    function create($campo1,$campo2,$campo3/*,...*/){
        
       
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into table1 (campo1,campo2,campo3) 
        values ('".$campo1."','".$campo2."','".$campo3."');";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
        }else{
               echo "No se ha podido insertar en la base de datos<br><br>".mysqli_error($conexion);
        }
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    /**
     * Modifica la tabla con los datos introducidos
     * @param type $name
     * @param type $name_twitter
     * @param type $fecha_inicio
     * @param type $fecha_final
     * @return type
     */
    function update($campo1,$campo2,$campo3/*,...*/){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE table1 SET "
                . "campo1 = '$campo1', "
                . "campo2 = '$campo1', "
                . "campo3 = '$campo1' 
        WHERE ID = $this->ID ;";
        $consulta = mysqli_query($conexion,$sql);
        if(!$consulta){
               echo "No se ha podido modificar la base de datos<br><br>".mysqli_error($conexion);
        }
        $connect->disconnectDB($conexion);
        return $consulta;
        
    }
    /**
     * Borra el elemento a partir de un ID dado
     * @param type $ID
     * @return type
     */ 
    function delete($ID){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "DELETE FROM table1 WHERE ID=$ID;";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
        }else{
               echo "No se ha podido borrar la table1<br><br>".mysqli_error($conexion);
        }
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    /**
     * Devuelve un array con la información de una fila a partir de un ID
     * @return type
     */
    
    function getData(){
        //Creamos la consulta
        $sql = "SELECT * FROM usuario WHERE ID = $this->ID;";
        //obtenemos el array
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }
    
    function getCampo1(){
        //Creamos la consulta
        $sql = "SELECT email FROM usuario WHERE ID = $this->ID;";
        //obtenemos el array
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array[0][0];
    }
    
    /**
     * Devuelve Toda la información de la tabla table1
     * @return type
     */
    function getAllInfo(){
        //Creamos la consulta
        $sql = "SELECT * FROM usuario;";
        //obtenemos el array
        $tool = new Tools();
        $array = $tool->getArraySQL($sql);
        return $array;
    }

    function getRol($email){
    	$sql = "SELECT rol FROM usuario WHERE email='$email';";
    	$tool = new Tools();
        $array = $tool->getArraySQL($sql);
        if($array[0]["rol"] == "0"){
        	$resul = "profesor";
        }else if($array[0]["rol"] == "1"){
        	$resul = "alumno";
        }
        return $resul;
    }
}