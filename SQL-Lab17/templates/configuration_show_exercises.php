<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
    include_once '../inc/ejercicio.php';
    include_once '../inc/tablas.php';
    $ejer = new Ejercicio();
    $id_ejer = $_GET['exercise'];
    $des = $ejer->getDescripcionEjercicio($id_ejer);
    ?>
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_exercises.php" > Ejercicios</a> > <a class="enlace" href="configuration_show_exercises.php?exercise=<?php echo $id_ejer ?>" > Ver Ejercicio</a></label>
    <h2><strong>Ver Ejercicio | <?php echo $des ?></strong></h2>
    <div class="row mb-5">
        <?php
        $tabla = new Tablas();
        $ejercicioId = $ejer->getEjercicioById($id_ejer);
        $dueño = $ejercicioId['dueño_tablas'];
        $tab = $tabla->getTablasByProfesor($dueño);
        ?>
        <div class="col-md-10">
            <p>Muestra el ejercicio con todos sus campos que se encuentran en la BBDD...</p>
        </div>
        <div class="col-md-2 p-0">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalCenterTabla">
                Tabla / Campos
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenterTabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTabla" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content color-white text-white">
                        <div class="modal-header border-bottom">
                            <h2 class="mt-4 pl-5">Creador de Tabla: <?php echo $ejercicioId['dueño_tablas']; ?></h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel.svg"/></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section id="tabs">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <nav>
                                                <div class="nav nav-tabs nav-fill" id="nav-tablas" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-t" data-toggle="tab" href="#nav-tab" role="tab" aria-controls="nav-tab" aria-selected="true">Tablas</a>
                                                    <a class="nav-item nav-link" id="nav-tab-camp" data-toggle="tab" href="#nav-tab-campos" role="tab" aria-controls="nav-tab-campos" aria-selected="false">Campos</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-ta">
                                                <div class="tab-pane fade show active mt-3 pl-4" id="nav-tab" role="tabpanel" aria-labelledby="nav-ta">
                                                    <div id="accordion ">
                                                        <div class="card">  
                                                            <div class="table-responsive scroll">                
                                                                <table id="employee" class="table table-striped table-bordered"> 
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:20%; text-align: center;">Nombre Tablas</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        <?php
                                                                        $quitar = $ejercicioId['dueño_tablas'] . "_";
                                                                        while ($fila = mysqli_fetch_array($tab)) {
                                                                            $onlyName = explode($quitar, $fila["nombre"]);
                                                                            ?>
                                                                            <tr>
                                                                                <td style="text-align: center;">                          
                                                                                    <?php echo $onlyName[1]; ?> 
                                                                                </td> 
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade mt-3 pl-4" id="nav-tab-campos" role="tabpanel" aria-labelledby="nav-tab-camp">
                                                    <div id="accordion ">
                                                        <div class="card">  
                                                            <div class="table-responsive scroll">                
                                                                <table id="employee-data" class="table table-striped table-bordered"> 
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:5px; text-align: center;">Campo</th> 
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $tab_col = $tabla->getCamposTabla($dueño);
                                                                        $_SESSION["columnas"] = "";
                                                                        while ($fila = mysqli_fetch_array($tab_col)) {
                                                                            echo '<tr>
                                                                                    <td style="text-align: center;">' . $fila["COLUMN_NAME"] . '</td>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div id="accordion ">
        <div class="card">  
            <div class="table-responsive">                
                <table id="employee" class="table table-striped table-bordered"> 

                    <thead>
                        <tr>
                            <th style="width:20%; text-align: center;">Nombre Ejercicio</th>
                            <th style="width:10%; text-align: center;">Nivel</th>
                            <th style="width:20%; text-align: center;">Tipo</th>
                            <th style="width:15%; text-align: center;">Profesor</th>
                            <th style="width:20%; text-align: center;">Creador Tabla</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td style="text-align: center;"> <?php echo $ejercicioId['descripcion']; ?> </td>
                    <td style="text-align: center;"> <?php echo $ejercicioId['nivel']; ?> </td>
                    <td style="text-align: center;"> <?php echo $ejercicioId['tipo']; ?> </td>
                    <td style="text-align: center;"> <?php echo $ejercicioId['creador_ejercicio']; ?> </td>
                    <td style="text-align: center;"> <?php echo $ejercicioId['dueño_tablas']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12 p-0 " id="accordion ">
        <div class="card">  
            <div class="table-responsive">                
                <table id="employee" class="table table-striped table-bordered"> 
                    <thead>
                        <tr>
                            <th style="width:20%; padding-left: 100px;">Enunciado</th>                         
                        </tr>
                    </thead>
                    <tbody>
                    <td style="padding-left: 150px;"> <?php echo $ejercicioId['enunciado']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?> 
