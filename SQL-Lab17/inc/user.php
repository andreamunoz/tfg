<?php

include_once 'functions.php';

class User {

    public $ID = 0;
    public $email;
    public $password;
    public $username;
    public $rol;
    public $modo;
    public $autoriza;
    public $name;
    public $apellidos;
    public $asociado;

    public function __contruct($email, $pass) {

        $this->email = $email;
        $this->pass = $pass;
    }

    public function __construct2($email, $pass, $name, $apellidos, $username, $rol, $modo, $autoriza,$asociado) {

        $this->email = $email;
        $this->pass = $pass;
        $this->name = $name;
        $this->apellidos = $apellidos;
        $this->username = $username;
        $this->rol = $rol;
        $this->modo = $modo;
        $this->autoriza = $autoriza;
        $this->asociado = $asociado;
    }

    public function existUser($email, $pass) {

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_usuario WHERE AES_DECRYPT(password,'SQLab')='$pass' AND email='$email'";
        $consulta = mysqli_query($conexion, $sql);
        $filas = mysqli_num_rows($consulta);
        while ($row = mysqli_fetch_row($consulta)) {
            $this->username = $row[0];
            $this->password = $row[1];
            $this->email = $row[2];
            $this->name = $row[3];
            $this->apellidos = $row[4];
            $this->rol = $row[5];
            $this->autoriza = $row[6];
            $this->asociado = $row[7];
        }
        $connect->disconnectDB($conexion);
        return $filas;
    }

    public function existUserEmail($email) {

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT email FROM sqlab_usuario WHERE email='$email'";
        $consulta = mysqli_query($conexion, $sql);
        $filas = mysqli_num_rows($consulta);
        $connect->disconnectDB($conexion);
        return $filas;
    }

    public function existUsername($username) {
        if($username !== "sqlab"){
            $connect = new Tools();
            $conexion = $connect->connectDB();
            $sql = "SELECT user FROM sqlab_usuario WHERE user='$username'";
            $consulta = mysqli_query($conexion, $sql);
            $filas = mysqli_num_rows($consulta);
            $connect->disconnectDB($conexion);
            return $filas;
        }else{
            return 1;
        }
    }

    //Crear usuario
    function createUser($name, $apellidos, $name_user, $rol, $email, $pass, $autoriza, $asociado) {


        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "insert into sqlab_usuario (nombre, apellidos, user, rol, email, password, autoriza, asociado) 
        values ('" . $name . "','" . $apellidos . "','" . $name_user . "','" . $rol . "','" . $email . "', AES_ENCRYPT('" . $pass . "','SQLab'),'" . $autoriza . "','" . $asociado . "');";
        $this->username = $name_user;
        $this->password = $pass;
        $this->email = $email;
        $this->name = $name;
        $this->apellidos = $apellidos;
        $this->rol = $rol;
        $this->autoriza = $autoriza;
        $this->asociado = $asociado;
        if (!($consulta = mysqli_query($conexion, $sql))) {
            echo "Falló la llamada para crear usuario: " . $conexion->error;
        } else {
            if ($rol == 1) {
                if (!($res = mysqli_query($conexion, "CALL sp_alumno_autoriza_null('" . $name_user . "');"))) {
                    echo "Falló el procedimiento alumno_autoriza_null";
                }
            }
        }

        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function updateUser($email,  $name, $apellidos, $autoriza, $asociado) {

        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE sqlab_usuario SET nombre = '$name', apellidos = '$apellidos', autoriza = '$autoriza', asociado = '$asociado'   
        WHERE email='$email'";
        $this->name = $name;
        $this->apellidos = $apellidos;
        $this->autoriza = $autoriza;
        $this->asociado = $asociado;
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getName() {

        return $this->name;
    }
    
    function getApellidos() {

        return $this->apellidos;
    }
    
    function getEmail() {

        return $this->email;
    }

    function getUserName() {

        return $this->username;
    }

    function getPassword() {

        return $this->password;
    }

    function getRol() {

        return $this->rol;
    }

    function setRol($rol) {

        $this->rol = $rol;
    }
    
    function getModo() {

        return $this->modo;
    }
    
    function setModo($modo) {

        $this->modo = $modo;
    }

    function getAutoriza() {

        return $this->autoriza;
    }
    
    function setAutoriza($autoriza) {

       $this->autoriza = $autoriza;
    }

    function getAsociado() {

        return $this->asociado;
    }
    
    function setAsociado($asociado) {

       $this->asociado = $asociado;
    }
    
    function getAllDatosUser($email) {
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT * FROM sqlab_usuario WHERE email='$email';";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }

    function getAvisosNoLeidos($user) {
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT DISTINCT mensaje FROM sqlab_avisos WHERE leido = 0 AND nombre = '$user'";
        $resultado = mysqli_query($conexion, $consulta);
        $resul = array();
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $resul[$i] = $fila["mensaje"];
            $i++;
        }
        $connect->disconnectDB($conexion);
        return $resul;
    }

    function getAvisos($user) {
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT DISTINCT mensaje FROM sqlab_avisos WHERE nombre = '$user'";
        $resultado = mysqli_query($conexion, $consulta);
        $resul = array();
        $i = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $resul[$i] = $fila["mensaje"];
            $i++;
        }
        $connect->disconnectDB($conexion);
        return $resul;
    }

    function setAvisosLeidos($user) {
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "UPDATE sqlab_avisos SET leido=1 WHERE nombre = '$user';";
        $resultado = mysqli_query($conexion, $consulta);
        $connect->disconnectDB($conexion);
        return $resultado;
    }
    
    function getNombreAlumnos(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT nombre FROM sqlab_usuario WHERE rol = '1';";
        $resultado = mysqli_query($conexion, $consulta);
        $connect->disconnectDB($conexion);
        return $resultado;
    }
    
    function getNombreAlumnosAsociados($nombreCompleto){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $consulta = "SELECT nombre, apellidos FROM sqlab_usuario WHERE rol = '1' AND asociado='$nombreCompleto';";
        $resultado = mysqli_query($conexion, $consulta);
        $connect->disconnectDB($conexion);
        return $resultado;
    }
    
    function existEmail($email){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT email FROM sqlab_usuario WHERE email='$email'";
        $consulta = mysqli_query($conexion, $sql);
        $email = mysqli_fetch_array($consulta);
        $connect->disconnectDB($conexion);
        return $email['email'];
    }
    
    function getNombreUsuario($email){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT nombre, apellidos FROM sqlab_usuario WHERE email='$email'";
        $consulta = mysqli_query($conexion, $sql);
        $name = mysqli_fetch_array($consulta);
        $connect->disconnectDB($conexion);
        return $name;
    }

    function getNombreApellidosUsuario($user){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT nombre, apellidos FROM sqlab_usuario WHERE user='$user'";
        $consulta = mysqli_query($conexion, $sql);
        $name = mysqli_fetch_array($consulta);
        $connect->disconnectDB($conexion);
        return $name;
    }

    function getChangePassword($email, $pass){
              
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "UPDATE sqlab_usuario SET sqlab_usuario.password = AES_ENCRYPT('$pass','SQLab') WHERE sqlab_usuario.email='$email'";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;        
    }
    
    function getAllProfesores(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT nombre, apellidos FROM `sqlab_usuario` WHERE rol=0";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;  
    }
}
