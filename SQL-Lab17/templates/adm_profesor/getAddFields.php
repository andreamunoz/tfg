<?php     
    session_start();                                        
    include_once '../../inc/functions.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" .$_REQUEST["tabla"]. "';";
    
    $consulta = mysqli_query($conexion, $sql);
    $_SESSION["columnas"] = "";
    $_SESSION["num_col"] = 0;
    $resultado = "";
    while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
        $resultado = $resultado . '<tr>
                <td style="text-align: center">' . $fila["COLUMN_NAME"] . '</td>
            </tr>';
    }
    $connect->disconnectDB($conexion);
    echo $resultado;
?>