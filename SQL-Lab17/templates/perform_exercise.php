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
    <label><a class="enlace" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlace" href="exercises.php" ><?php echo trad('Ejercicios',$lang) ?> </a> > <a class="enlace" href="perform_exercise.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Realizar Ejercicio',$lang) ?></a></label>
    <h2><strong><?php echo $des ?></strong></h2>
    <div class="row mb-5">
        <?php
        $tabla = new Tablas();
        $ejercicioId = $ejer->getEjercicioById($id_ejer);
        $dueño = $ejercicioId['dueño_tablas'];
        $tab = $tabla->getTablasByProfesor($dueño);
        ?>
        <div class="col-md-10">
            <p><?php echo trad('Resuelve el ejercicio según el enunciado propuesto por el profesor.',$lang) ?></p>
        </div>
        <div class="col-md-2 p-0">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalCenterTabla">
                <?php echo trad('Tabla / Campos',$lang) ?>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenterTabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTabla" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content color-white text-white">
                        <div class="modal-header border-bottom">
                            <h2 class="mt-4 pl-5"><?php echo trad('Creador de Tabla: ',$lang) ?><?php echo $ejercicioId['dueño_tablas']; ?></h2>
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
                                                    <a class="nav-item nav-link active" id="nav-t" data-toggle="tab" href="#nav-tab" role="tab" aria-controls="nav-tab" aria-selected="true"><?php echo trad('Tablas',$lang) ?></a>
                                                    <a class="nav-item nav-link" id="nav-tab-struct" data-toggle="tab" href="#nav-tab-structure" role="tab" aria-controls="nav-tab-stru" aria-selected="false"><?php echo trad('Estructura',$lang) ?></a>
                                                    <a class="nav-item nav-link" id="nav-tab-camp" data-toggle="tab" href="#nav-tab-campos" role="tab" aria-controls="nav-tab-campos" aria-selected="false"><?php echo trad('Datos',$lang) ?></a>
                                                </div>
                                            </nav>
                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-ta">
                                                <div class="tab-pane fade show active mt-3 pl-4" id="nav-tab" role="tabpanel" aria-labelledby="nav-tab-tables">
                                                    <div id="accordion ">
                                                        <div class="card">  
                                                            <div class="selector-tabla-sol" >
                                                                <select name="tablas_sol" class=" custom-select form-control-sm" id="tablas_sol" title="Selecciona" required>
                                                                <option value=""> Selecciona tabla</option>
                                                                <?php
                                                                $quitar = $ejercicioId['dueño_tablas'] . "_";
                                                                
                                                                while ($fila = mysqli_fetch_array($tab)) {
                                                                    // $_SESSION['table_name_show'] = $fila["nombre"];
                                                                    $onlyName = explode($quitar, $fila["nombre"]);
                                                                    ?>
                                                                    <option value="<?php echo $fila["nombre"] ?>">
                                                                        <?php echo $onlyName[1]; ?> 
                                                                    </option> 
                                                                <?php } ?>                                  
                                                                </select>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade mt-3 pl-4" id="nav-tab-structure" role="tabpanel" aria-labelledby="nav-tab-st">
                                                    <div id="accordion ">
                                                        <div class="card">  
                                                            <div class="table-responsive scroll">                
                                                                <table id="employee_data" class="table table-striped table-bordered structure">  
                                                                    <thead>
                                                                        <tr>                                         
                                                                            <tr>                                         
                                                                            <th style="width:30%;"><?php echo trad('Nombre Columna',$lang) ?></th>
                                                                            <th style="width:30%;"><?php echo trad('Tipo Columna',$lang) ?></th>
                                                                            <th style="width:20%;"><?php echo trad('Acepta NULL',$lang) ?></th>
                                                                            <th style="width:20%;"><?php echo trad('Clave',$lang) ?></th>                                           
                                                                        </tr>                                           
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
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

                                                                <table id="employee_data" class="table table-striped table-bordered data">  
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
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="col-md-6 p-0 float-right" id="accordion ">
        <div class="card">  
            <div class="table-responsive">                
                <table id="employee" class="table table-striped table-bordered"> 
                    <thead>
                        <tr>
                            <th style="width:20%; text-align: center"><?php echo trad('Solución',$lang) ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                    <?php echo '<form action="../handler/validate_exercise.php?exercise=' . $fila['id_ejercicio'] . '" method="post">' ?>
                        <tr>
                            <td>
                                <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="18" placeholder="<?php echo trad('Escribe la solución aquí...',$lang) ?>" required></textarea>
                            </td>
                            
                        </tr>                       
                    <?php echo '</form>'; ?>
                    </tbody>
                </table>
                <button type="submit" id="alert-sol" class="btn btn-primary mt-5 mb-5 pl-5 pr-5 float-right"><?php echo trad('Ejecutar',$lang) ?></button>
            </div>
        </div>
    </div>
    <div class="col-md-6 pl-0 pr-3" id="accordion ">
        <div class="card">  
            <div class="table-responsive">                
                <table id="employee" class="table table-striped table-bordered"> 
                    <thead>
                        <tr>
                            <th style="width:20%; text-align: center"><?php echo trad('Enunciado',$lang) ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                    <td > <?php echo $ejercicioId['enunciado']; ?> </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['msg_solucion'])) {
        echo $_SESSION['msg_solucion'];
        unset($_SESSION['msg_solucion']);
    }
    ?>
</div>
    <script type="text/javascript">
        //$("#modalSolucion").removeClass('show'); /*****************************/
        /*$(document).ready(function () {
            setTimeout("$('div').removeClass('show');", 5000);
        });*/
    </script>
<?php include("footer.php"); ?> 