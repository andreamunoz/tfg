<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_tables.php" > <?php echo trad('Tablas',$lang) ?></a></label>
    <h2><strong><?php echo trad('Tablas',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="offset-md-10 col-md-2">
            <div class="text-right">
                <a type="button" class="btn btn-primary pl-3 pr-3" href="configuration_new_tables.php" ><?php echo trad('Ejecutar Script',$lang) ?></a>
            </div>
        </div>
    </div>
    <div id="accordion">
        <div class="card" > 
            <div class="row">
                <div class="col-md-3">
                    <div class="table-responsive" style="margin-top: 71px;">  
                        <table id="employee" class="table table-striped-config table-bordered tabla-tablas">  
                            <thead>
                                <tr>
                                    <th style="width:30%;"><?php echo trad('Tablas',$lang) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once '../inc/functions.php';
                                $connect = new Tools();
                                $conexion = $connect->connectDB();
                                $sql = "SELECT td.nombre, td.schema_prof from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.user = '".$_SESSION['user']."'";
                                $consulta = mysqli_query($conexion, $sql);
                                while (($fila = mysqli_fetch_array($consulta))) {

                                    $sql2 = "SELECT COUNT(*) As NumeroCampos FROM Information_Schema.Columns WHERE Table_Name = '" . $fila["nombre"] . "' GROUP BY Table_Name;";
                                    $consulta2 = mysqli_query($conexion, $sql2);
                                    while (($fila2 = mysqli_fetch_array($consulta2))) {
                                        $campos = $fila2["NumeroCampos"];
                                    }
                                    $quitar = $fila["schema_prof"] . "_";
                                    $onlyName = explode($quitar, $fila["nombre"]);
                                    echo '<tr> <td class="resaltado" data-name="'.$fila["nombre"].'"> ' . $onlyName[1] . '</td> </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="VBar"></div>
                <div class="col-md-9 resultados" id="tabs">
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
                                        <table id="structure_table" > <!-- class="table table-striped table-bordered">   -->
                                            <thead>
                                                
                                            </thead>
                                            <tbody>
                                                
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
                                        <table id="structure_table">
                                            <thead>
                                            
                                            </thead>
                                            <tbody>
                                                
                                            </tbody> 
                                            
                                        </table>
                                    </div>  
                                </div> 
                            </div>
                        </div>
                    </div>

                </div>
            </div> 
             
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
