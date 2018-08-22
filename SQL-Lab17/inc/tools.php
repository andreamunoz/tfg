<?php
include_once 'functions.php';

class Tools{
    /**
     * Devuelve una instancia de la conexión a la base de datos
     * @return type
     */
    function connectDB(){
        
        $conexion = mysqli_connect(SERVER, USER, PASS, DB);
        if($conexion){
        }else{
               echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>';
        }
        mysqli_query ($conexion,"SET NAMES 'utf8'");
        mysqli_set_charset($conexion, "utf8");
        mysqli_query($conexion, "SET collation_connection = utf8_spanish_ci");
        return $conexion;
    }

    /**
     * Desconecta la base de datos a partir de la instancia que le pasamos
     * @param type $conexion
     * @return type
     */
    function disconnectDB($conexion){
       $close = mysqli_close($conexion);
                if($close){
                }else{
                    echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
                }   
        return $close;
    }
    
    /**
     * Obtenemos un array multidimensional a partir de una sentencia SQL de entrada
     * @param type $sql
     * @return type
     */
    function getArraySQL($sql){
        //Creamos la conexiÃ³n
        $conexion = $this->connectDB();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die(mysqli_error($conexion));
        $rawdata = array();
        //guardamos en un array multidimensional todos los datos de la consulta
        $i=0;
        while($row = mysqli_fetch_array($result))
        {
            $rawdata[$i] = $row;
            $i++;
        }
        $this->disconnectDB($conexion);
        return $rawdata;
    }
    
    /**
     * Dibujamos en pantalla una tabla a partir de un array multidimensional de entrada
     * @param type $rawdata
     */
    function displayTable($rawdata){

        //DIBUJAMOS LA TABLA
        echo '<table class="table table-striped table-bordered table-condensed">';
        $columnas = count($rawdata[0])/2;
        //echo $columnas;
        $filas = count($rawdata);
        //echo "<br>".$filas."<br>";
        //Añadimos los titulos
            
        for($i=1;$i<count($rawdata[0]);$i=$i+2){
            next($rawdata[0]);
            echo "<th><b>".key($rawdata[0])."</b></th>";
            next($rawdata[0]);
        }
        for($i=0;$i<$filas;$i++){
            echo "<tr>";
            for($j=0;$j<$columnas;$j++){
                echo "<td>".$rawdata[$i][$j]."</td>";
                
            }
            echo "</tr>";
        }       
        echo '</table>';
    }
    
    function displayError($title,$message){
            ?>
            <div class="row">
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">
                    <div class="page-header">
                        <h1><?php echo $title; ?></h1>
                    </div>
                    <div class="alert alert-info">
                        <?php echo $message; ?>
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
            <?php
            
    }

}