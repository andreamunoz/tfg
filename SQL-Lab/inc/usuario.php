<?php
include_once 'functions.php';

class Usuario{

    public $ID = 0;
    public $email;
    public $password;

    function createUser($name,$apellidos,$name_user,$rol,$email,$pass){
        
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into usuario (nombre,apellidos,user,rol,email,password) 
        values ('".$name."','".$apellidos."','".$name_user."','".$rol."','".$email."','".$pass."');";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
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
        $sql = "SELECT email FROM usuario WHERE email='$email';";
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
        $sql = "SELECT user FROM usuario WHERE email='$email';";
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
        $sql = "SELECT password FROM usuario WHERE email='$email';";
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
        $sql = "SELECT rol FROM usuario WHERE email='$email';";
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
        $sql = "SELECT * FROM usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion,$sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}