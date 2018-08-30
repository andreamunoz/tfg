<?php                                             
    include_once '../inc/functions.php';
    $connect = new Tools();
    $conexion = $connect->connectDB();
    $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" .$_SESSION['table_name_show'] . "';";
    
    $consulta = mysqli_query($conexion, $sql);
    $_SESSION["columnas"] = "";
    $_SESSION["num_col"] = 0;
    $resultado = "";
    while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
        $resultado = $resultado . '<tr>
                <td>' . $fila["COLUMN_NAME"] . '</td>
                <td>' . $fila["COLUMN_TYPE"] . '</td>
                <td>' . $fila["IS_NULLABLE"] . '</td>
                <td>' . $fila["COLUMN_KEY"] . '</td>
            </tr>';
        $_SESSION["columnas"] = $_SESSION["columnas"] . "*" . $fila["COLUMN_NAME"];
        $_SESSION["num_col"] = $_SESSION["num_col"] + 1; 
    }
    $connect->disconnectDB($conexion);
    echo $resultado;
?>