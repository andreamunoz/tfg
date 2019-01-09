<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
    include_once '../inc/ejercicio.php';
    include_once '../inc/tablas.php';
    include_once '../inc/usa.php';
    include_once '../inc/solucion.php';
    $ejer = new Ejercicio();
    $id_ejer = $_GET['exercise'];
    $des = $ejer->getDescripcionEjercicio($id_ejer);
    ?>
    <div class='modal fade show sol_message' id='modal-close-mess' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' style='display:block; visibility: hidden; '>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <div class='close sol_close' id='close-modal-mess'>
                        <i class='fas fa-times' data-dismiss='modal'></i>
                    </div>
                </div>
                <div class='modal-body'>
                    <h5><?php echo trad('Solución',$lang) ?>:</h5>
                    <p></p>
                </div>
            </div>
        </div>   
    </div>
    <label><a class="enlace" href="index.php" ><?php echo trad('Inicio', $lang) ?> </a> > <a class="enlace" href="exercises.php" ><?php echo trad('Ejercicios', $lang) ?> </a> > <a class="enlace" href="perform_exercise.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Realizar Ejercicio', $lang) ?></a></label>
    <h2><strong><?php echo $des ?></strong></h2>
    <div class="row mb-3">
        <?php
        $tabla = new Tablas();
        $datos_ejercicioId = $ejer->getEjercicioById($id_ejer);
        $dueño = $datos_ejercicioId['dueño_tablas'];
        $_SESSION["solProf"] = $datos_ejercicioId['solucion'];
        $_SESSION["duenoTablas"] = $datos_ejercicioId['dueño_tablas'];
        $_SESSION["idEjer"] = $datos_ejercicioId['id_ejercicio'];
        $tab = $tabla->getTablasByProfesor($dueño);
        ?>
        <div class="col-md-10">
            <p><?php echo trad('Resuelve el ejercicio según el enunciado propuesto por el profesor.', $lang) ?></p>
        </div>
        <div class="col-md-2 p-0">

        </div>
    </div>  
    <section id="tabs">
        <div class="">
            <div class="row">
                <div class="col-md-12 ">                  
                    <?php echo '<form action="../handler/validate_exercise.php?exercise=' . $id_ejer . '" method="post">' ?>
                    <div class="col-md-12" id="p_boton">
                        <button type="submit" id="alert-sol" class="btn btn-primary mt-0 mb-2 pl-5 pr-5 f_right"><?php echo trad('Validar', $lang) ?></button>
                    </div>
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-exercisesD-tab" data-toggle="tab" href="#nav-new-exercises" role="tab" aria-controls="nav-new-exercises" aria-selected="true"><?php echo trad('Resolver',$lang) ?></a>
                            <?php if ($datos_ejercicioId["tipo"] !== "Operaciones Manipulacion de Datos" ) {?>
                            <a class="nav-item nav-link" id="nav-exercisesE-tab" data-toggle="tab" href="#nav-exercisesE" role="tab" aria-controls="nav-enun-sol" aria-selected="false"><?php echo trad('Resultados',$lang) ?></a>
                            <?php } ?>
                            <a class="nav-item nav-link" id="nav-exercises-historico" data-toggle="tab" href="#nav-historico" role="tab" aria-controls="nav-exercise-hist" aria-selected="false"><?php echo trad('Soluciones previas', $lang) ?></a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-exercises" role="tabpanel" aria-labelledby="nav-exercisesD-tab">
                            <div>
                                <div class="row">
                                    
                                    <div class="col-md-6 pl-0 mb-3" id="accordion ">
                                        <label><strong><?php echo trad('Tablas',$lang) ?></strong></label>
                                        <div class="sel-tab-show" >
                                            <select type="text" id="tablas" name="tablas" class="custom-select form-control-sm"> 
                                                <option value="">Selecciona Tabla</option>
                                            <?php 
                                                $usa = new Usa();
                                                $nombre_tablas = $usa->getNombreById($id_ejer);
                                                while ($nameTable = mysqli_fetch_array($nombre_tablas)) {
                                                
                                                    $quitar = $nameTable['schema_prof'] . "_";
                                                    $onlyName = explode($quitar, $nameTable['nombre']);
                                                    
                                                    echo "<option value='".$nameTable['nombre']."'>".$onlyName[1]."</option>"; 
                                                  
                                                }
                                             ?>
                                            </select>                               
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2" id="accordion ">
                                        <div >
                                            <div class="col-tab-show" >
                                                <table id="structure_table" class="" >
                                                    <thead class="light-style">
                                                                        
                                                    </thead>
                                                    <tbody class="body-tablas-style">
                                                        
                                                    </tbody>
                                                </table>                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6 pl-0 pr-3 float-left" id="accordion ">
                                        <div class="card">  
                                            <div class="table-responsive">
                                                <label><strong><?php echo trad('Enunciado',$lang) ?></strong></label>                
                                                <table class="form-control"> 
                                                    <tbody>
                                                    <td style="padding: 15px; word-break: break-all;"> <?php echo $datos_ejercicioId['enunciado']; ?> </td>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0 float-right" id="accordion ">
                                        <div class="card">  
                                            <div class="table-responsive">
                                                
                                                <table id="employee" class="dis_pt"> 
                                                    <thead  class="light-style">
                                                        <tr class="trow">
                                                            <th style="width:20%;"><?php echo trad('Solución', $lang) ?></th>                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr>
                                                            <td>
                                                                <?php if (isset($_SESSION["solAlum"])){ ?>
                                                                    <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="12" maxlength="600" required><?php echo $_SESSION["solAlum"]; ?></textarea>
                                                                <?php } else { ?>
                                                                    <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="12" maxlength="600" placeholder="<?php echo trad('Escribe la solución aquí...', $lang) ?>" required></textarea>
                                                                <?php } ?>
                                                            </td>

                                                        </tr> 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        <?php if ($datos_ejercicioId["tipo"] !== "Operaciones Manipulacion de Datos" ) {?>
                        <div class="tab-pane fade mt-3 pl-4" id="nav-exercisesE" role="tabpanel" aria-labelledby="nav-exercisesE-tab">
                            <div class="float-right col-md-6 pl-0 pl-3" id="contenedorDeResultados">
                                <div class="card">  
                                    <div class="table-responsive alumnoResultadoSolucion">
                                        <p><?php echo trad('Solución Alumno', $lang) ?></p>
                                        <table id="employee" class="table table-striped table-bordered"> 
                                            <thead>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-2" id="contenedorDeResultados">
                                <div class="card">  
                                    <div class="table-responsive profesorResultadoSolucion">
                                        <p><?php echo trad('Solución Profesor', $lang) ?></p>
                                        <table id="employee" class="table table-striped table-bordered"> 
                                            <thead>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>  
                        <div class="tab-pane fade mt-3 pl-4" id="nav-historico" role="tabpanel" aria-labelledby="nav-exercises-historico">
                            <div id="accordion ">
                                <div class="card pt-4">  
                                    <div class="table-responsive no-buscar">  
                                        <table id="employee_data" class="table table-striped table-bordered">  
                                            <thead>
                                                <tr>
                                                    <th class="ancho_intento"><?php echo trad('Nº de intento',$lang) ?></th>
                                                    <th class="ancho_fecha" ><?php echo trad('Fecha y hora',$lang) ?></th>
                                                    <th class="ancho_vered"><?php echo trad('Veredicto',$lang) ?></th>
                                                    <th class="ancho_sol"><?php echo trad('Solución',$lang) ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaSolucionesPropuesta"> 
                                                <?php 
                                                    /*onclick="activarTabSolucion()"*/
                                                    $sol = new Solucion(); 
                                                    $historico = $sol->getHistoricoEjercicios($id_ejer, $_SESSION ["user"]);
                                                    while($arrayHistorico = mysqli_fetch_array($historico)){
                                                ?>
                                                    <tr  class="solucionPropuesta" > 
                                                        <!-- data-sol="<?php //echo '"'.$arrayHistorico['solucion_propuesta'].'"'; ?>" -->
                                                        <td> <?php echo $arrayHistorico['intentos']; ?> </td>
                                                        <td> <?php echo $arrayHistorico['fecha']; ?> </td>
                                                        <td> 
                                                            <?php if ($arrayHistorico['veredicto'] == 1){
                                                                echo trad('Acierto',$lang);
                                                            } else {
                                                                echo trad('Fallo', $lang);
                                                            } ?> 
                                                        </td>
                                                        <td id="sol_propuesta"> 
                                                            <?php echo $arrayHistorico['solucion_propuesta']; ?> 
                                                        </td>
                                                    </tr>    
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>  
                                </div> 
                            </div>
                        </div>
                    </div>                   
                    <?php echo '</form>'; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_SESSION['msg_solucion'])) {
        echo $_SESSION['msg_solucion'];
        unset($_SESSION['msg_solucion']);
    }
    ?>
</div>
<?php include("footer.php"); ?> 