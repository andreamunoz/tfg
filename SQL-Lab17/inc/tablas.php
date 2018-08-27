<?php

include_once 'functions.php';

class Tablas {

    public $nameTable;
    public $schemaProf;

    public function __contruct($nameTable, $schemaProf) {

        $this->nameTable = $nameTable;
        $this->schemaProf = $schemaProf;
    }

    public function getAllSchemas(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(schema_prof) FROM sqlab_tablas_disponibles where schema_prof<>''";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    public function getTablas(){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(td.schema_prof) from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof<>'' and u.autoriza = 1;";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    public function getTablasByProfesor($dueño){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT DISTINCT(td.nombre) from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = '$dueño' and u.autoriza = 1";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
    
    public function getCamposTabla($dueño){
        $connect = new Tools();
        $conexion = $connect->connectDB();
        $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS";
        $consulta = mysqli_query($conexion, $sql);
        $connect->disconnectDB($conexion);
        return $consulta;
    }
}
