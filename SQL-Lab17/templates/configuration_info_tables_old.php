<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
    $_SESSION["nombre_tabla"] = $_GET['name'];
    $nombre_tabla = $_GET['name'];
    $num_campos = $_GET['num'];
    ?>
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_tables.php" > <?php echo trad('Tablas',$lang) ?></a> > <a class="enlace" href="configuration_info_tables.php?name=<?php echo $nombre_tabla ?>&num=<?php echo $num_campos ?>" ><?php echo trad('Información Tablas',$lang) ?> </a></label>
    <h2><strong><?php echo trad('Tablas',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-9">
            <p><?php echo trad('Muestra la estructura de las tablas y los datos de los campos correspondientes a esa tabla.',$lang) ?></p>
        </div>

    </div> 
    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-tablesE-tab" data-toggle="tab" href="#nav-table-structure" role="tab" aria-controls="nav-table-struct" aria-selected="true"><?php echo trad('Estructura',$lang) ?></a>
                            <a class="nav-item nav-link" id="nav-tablesD-tab" data-toggle="tab" href="#nav-table-datos" role="tab" aria-controls="nav-table-dat" aria-selected="false"><?php echo trad('Datos',$lang) ?></a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active mt-3 pl-4" id="nav-table-structure" role="tabpanel" aria-labelledby="nav-tablesE-tab">
                            <div id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">  
                                        <table id="employee_data" class="table table-striped table-bordered">  
                                            <thead>
                                                <tr>                                                      
                                                    <th style="width:30%;"><?php echo trad('Nombre Columna',$lang) ?></th>
                                                    <th style="width:30%;"><?php echo trad('Tipo Columna',$lang) ?></th>
                                                    <th style="width:30%;"><?php echo trad('Acepta',$lang) ?> NULL</th>
                                                    <th style="width:20%;"><?php echo trad('Clave',$lang) ?></th>                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                             
                                                include_once '../inc/functions.php';
                                                $connect = new Tools();
                                                $conexion = $connect->connectDB();
                                                $sql = "SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $nombre_tabla . "';";
                                                $consulta = mysqli_query($conexion, $sql);
                                                $_SESSION["columnas"] = "";
                                                while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
                                                    echo '<tr>
                                                            <td>' . $fila["COLUMN_NAME"] . '</td>
                                                            <td>' . $fila["COLUMN_TYPE"] . '</td>
                                                            <td>' . $fila["IS_NULLABLE"] . '</td>
                                                            <td>' . $fila["COLUMN_KEY"] . '</td>
                                                        </tr>';
                                                    $_SESSION["columnas"] = $_SESSION["columnas"] . "*" . $fila["COLUMN_NAME"];
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade mt-3 pl-4" id="nav-table-datos" role="tabpanel" aria-labelledby="nav-tablesD-tab">
                            <div id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">  
                                        <table id="employee_table" class="table table-striped table-bordered">  
                                            <thead>
                                                <tr>                                                      
                                                    <?php
                                                    $array_columnas = array($num_campos);
                                                    $columnas = explode("*", $_SESSION["columnas"]);
                                                    $nada = array_shift($columnas);
                                                    foreach ($columnas as $key => $value) {
                                                        echo '<th>' . $value . '</th>';
                                                        $array_columnas[$key] = $value;
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once '../inc/functions.php';
                                                $connect = new Tools();
                                                $conexion = $connect->connectDB();
                                                $sql = "SELECT * from " . $nombre_tabla . ";";
                                                $consulta = mysqli_query($conexion, $sql);

                                                while (($fila = $consulta->fetch_array(MYSQLI_ASSOC))) {
                                                    echo '<tr>';
                                                    foreach ($fila as $key => $value) {
                                                        echo '<td>' . $value . '</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>  
                                </div> 
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['message_tables'])) {
                        echo $_SESSION['message_tables'];
                        unset($_SESSION['message_tables']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?> 
