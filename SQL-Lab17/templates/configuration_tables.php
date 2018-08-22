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
                            <p class="pl-5">+ <strong><i>Ver:</i></strong> Puede ver el contenido (nombre, creador, campos...) que tiene la tabla seleccionada.</p>
                            
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
                            <th style="width: 60%">Campos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        <!-- REALIZAR LISTA DE TABLAS -->
                        <?php
                        include_once '../inc/hoja_ejercicio.php';
                        include_once '../inc/esta_contenido.php';
                        $hojaejer = new HojaEjercicio();
                        $result = $hojaejer->getAllHojas();
                        if (isset($result)) {

                            while ($fila_hoja = mysqli_fetch_array($result)) {
                                ?>

                                <tr class="accordion-toggle" id="show-accordion" >
                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre_hoja'] . '</td>'; ?>

                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['creador_hoja'] . '</td>'; ?>
                                    <?php
                                    $number = new EstaContenido();
                                    $id_hoja = $fila_hoja['id_hoja'];
                                    $row_number = $number->getNumberEjerciciosByHoja($id_hoja);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_number["COUNT(id_ejercicio)"] . '</td>';
                                    ?>
                                    <?php echo '<td><a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_edit_sheets.php?hoja=' . $fila_hoja['id_hoja'] . '">Editar</a></td>'; ?>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                    if(isset($_SESSION['message_tables'])){
                        echo $_SESSION['message_tables'];
                        unset($_SESSION['message_tables']);
                    }
                ?>
            </div>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
