<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_tables.php" > Tablas</a></label>
    <h2><strong>Tablas</strong></h2>
    <div class="row mb-150">
        <div class="col-md-9">
            <p>Añade, edita y elimina las tablas que tengan los ejercicios...</p>
        </div>
        <div class="col-md-3 p-0">
            <a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_new_tables.php" >Crear Tabla</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalCenter">
                Ayuda
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="mt-4 pl-5">Ayuda</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel_blanco.svg"/></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="pl-5">+ <strong><i>Crear tabla:</i></strong> Añade la consulta para Crear/Update/Drop a la tabla. </p>
                            <p class="pl-5">+ <strong><i>Ver detalles:</i></strong></p>
                            <p class="pl-5"><strong>Estructura </strong>(Puede ver las columnas que tiene la tabla y el tipo al que corresponde dicho campo)</p>
                            <p class="pl-5"><strong>Datos </strong>(Puede ver el contenido que tienen los campos de esa tabla)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion">
        <div class="card" >  
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped-conf table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:30%;">Nombre Tabla</th>
                            <th style="width:30%;">Creador Tabla</th>
                            <th style="width:40%;">Nº de columnas</th>
                            <th style="width:20%;"></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                        include_once '../inc/functions.php';
                        $connect = new Tools();
                        $conexion = $connect->connectDB();
                        $sql = "SELECT td.nombre, td.schema_prof from sqlab_tablas_disponibles as td, sqlab_usuario as u where td.schema_prof = u.user and u.autoriza = 1";
                        $consulta = mysqli_query($conexion, $sql);
                        while (($fila = mysqli_fetch_array($consulta))) {

                            $sql2 = "SELECT COUNT(*) As NumeroCampos FROM Information_Schema.Columns WHERE Table_Name = '" . $fila["nombre"] . "' GROUP BY Table_Name;";
                            $consulta2 = mysqli_query($conexion, $sql2);
                            while (($fila2 = mysqli_fetch_array($consulta2))) {
                                $campos = $fila2["NumeroCampos"];
                            }
                            $quitar = $fila["schema_prof"] . "_";
                            $onlyName = explode($quitar, $fila["nombre"]);
                            echo '<tr>
                                    <td>' . $onlyName[1] . '</td>
                                    <td>' . $fila["schema_prof"] . '</td>
                                    <td>' . $campos . '</td>
                                    <td>
                                        <a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_info_tables.php?name=' . $fila["nombre"] . '&num=' . $campos . '"> Ver Detalles </a>
                                    </td>
                                </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <?php
                if(isset($_SESSION['message_new_tables'])){
                    echo $_SESSION['message_new_tables'];
                    //var_dump($_SESSION['message_new_tables']) ;
                    unset($_SESSION['message_new_tables']);
                }
            ?>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
