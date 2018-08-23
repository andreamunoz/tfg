<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php $_SESSION["nombre_tabla"] = $_GET['name']; 
    $nombre_tabla = $_GET['name'];
    $num_campos = $_GET['num'];
    ?>
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_tables.php" > Tablas</a> > Información Tablas</label>
    <h2><strong>Tablas</strong></h2>
    <div class="row mb-150">
        <div class="col-md-9">
            <p>Añade, edita y elimina las tablas que tengan los ejercicios...</p>
        </div>

    </div>

     <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-tablesE-tab" data-toggle="tab" href="#nav-table-structure" role="tab" aria-controls="nav-new-exercises" aria-selected="true">Estructura</a>
                            <a class="nav-item nav-link" id="nav-tablesI-tab" data-toggle="tab" href="#nav-table-data" role="tab" aria-controls="nav-new-table" aria-selected="false">Datos</a>

                        </div>
                    </nav>
                    <div class="tab-pane fade show active mt-3 pl-4" id="nav-table-structure" role="tabpanel" aria-labelledby="nav-tablesE-tab">
                        <div class="table-responsive">
                        <table id="DT" class="table table-striped-conf table-bordered" data-name = "">  
                            <thead>
                                <tr>
                                    <th style="width:30%;">Nombre Columna</th>
                                    <th style="width:30%;">Tipo Columna</th>
                                    <th style="width:40%;">Acepta NULL</th>
                                    <th style="width:20%;">Clave</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody >
                                
                                <?php
                                include_once '../inc/functions.php';
                                $connect = new Tools();
                                $conexion = $connect->connectDB();
                                $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$nombre_tabla."';";
                                $consulta =  mysqli_query($conexion,$sql);
                                $_SESSION["columnas"] = "";
                                while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
                                    echo '<tr>
                                            <td>'.$fila["COLUMN_NAME"].'</td>
                                            <td>'.$fila["COLUMN_TYPE"].'</td>
                                            <td>'. $fila["IS_NULLABLE"] .'</td>
                                            <td>'.$fila["COLUMN_KEY"].'</td>
                                        </tr>';
                                    $_SESSION["columnas"] = $_SESSION["columnas"]."*".$fila["COLUMN_NAME"];
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="tab-pane fade mt-3 pl-4" id="nav-table-data" role="tabpanel" aria-labelledby="nav-tablesI-tab">
                        <div class="table-responsive">

                        <table id="DT" class="table table-striped-conf table-bordered" data-name = "">  
                            <thead>
                                <tr>
                                <?php  
                                    $array_columnas = array($num_campos);
                                    $columnas = explode("*", $_SESSION["columnas"]);
                                    $nada = array_shift($columnas);
                                    foreach ($columnas as $key => $value) {
                                        echo '<td>'.$value.'</td>';
                                        $array_columnas[$key] = $value;
                                    }
                                ?>
                                </tr>
                            </thead>
                            <tbody >
                                
                                <?php
                                include_once '../inc/functions.php';
                                $connect = new Tools();
                                $conexion = $connect->connectDB();
                                $sql = "SELECT * from ".$nombre_tabla.";";
                                $consulta =  mysqli_query($conexion,$sql);
                                
                                while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
                                    echo '<tr>';
                                    foreach ($fila as $key => $value) {
                                        echo '<td>'.$value.'</td>';
                                    }
                                    echo '</tr>';
                                } ?>

                            </tbody>
                        </table>
                        </div>

                    </div>
                    <?php
                        if(isset($_SESSION['message_tables'])){
                            echo $_SESSION['message_tables'];
                            unset($_SESSION['message_tables']);
                        }
                    ?>
                </div> 
            </div> 
        </div>
    </section>    
</div>

<?php include("footer.php"); ?> 
