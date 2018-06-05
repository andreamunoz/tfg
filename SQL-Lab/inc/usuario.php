<?php
include_once 'functions.php';

class Usuario{

    public $ID = 0;
    public $email;
    public $password;



    //Crear usuario
    function createUser($name,$apellidos,$name_user,$rol,$email,$pass,$autoriza){

        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into sqlab_usuario (nombre, apellidos, user, rol, email, password, autoriza) 
        values ('".$name."','".$apellidos."','".$name_user."','".$rol."','".$email."', AES_ENCRYPT('".$pass."','SQLab'),'".$autoriza."');";
        
        if(!($consulta = mysqli_query($conexion,$sql))){
            echo "Falló la llamada para crear usuario: ".$conexion->error;
        }else{
            if($rol == 1){
                if(!($res = mysqli_query($conexion, "CALL sp_alumno_autoriza_null('".$name_user."');"))){
                    echo "Falló el procedimiento alumno_autoriza_null";
                }
                
            }
        }
        var_dump($resul);
        //echo $conexion->error;
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    //NO SE UTILIZA
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

    function getEmail($email){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT email FROM sqlab_usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
            $result = $consulta->fetch_array();
        }
        $connect->disconnectDB($conexion);
        return $result[0];
    }

    function getUser($email){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT user FROM sqlab_usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
            $result = $consulta->fetch_array();
        }
        $connect->disconnectDB($conexion);
        return $result[0];
    }

    function getPassword($email){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT AES_DECRYPT(password,'SQLab') FROM sqlab_usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
            $result = $consulta->fetch_array();
        }
        $connect->disconnectDB($conexion);
        return $result[0];
    }

    function getRol($email){
    	$connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT rol FROM sqlab_usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
            $result = $consulta->fetch_array();
        }
        $connect->disconnectDB($conexion);
        return $result[0];
    }

    function getAllDatosUser($email){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAvisosNoLeidos($user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT mensaje FROM sqlab_avisos WHERE leido = 0 AND nombre = '$user'";
        $resultado = mysqli_query($conexion,$consulta);
        $resul = array();
        $i=0;
        while ($fila = $resultado->fetch_assoc()) {
            $resul[$i] = $fila["mensaje"];
            $i++;
        }
        $connect->disconnectDB($conexion);
        return $resul;
    }

    function getAvisos($user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT mensaje FROM sqlab_avisos WHERE nombre = '$user'";
        $resultado = mysqli_query($conexion,$consulta);
        $resul = array();
        $i=0;
        while ($fila = $resultado->fetch_assoc()) {
            $resul[$i] = $fila["mensaje"];
            $i++;
        }
        $connect->disconnectDB($conexion);
        return $resul;
    }

    function setAvisosLeidos($user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "UPDATE sqlab_avisos SET leido=1 WHERE nombre = '$user';";
        $resultado = mysqli_query($conexion,$consulta); 
        $connect->disconnectDB($conexion);
        return $resultado;
    }
}