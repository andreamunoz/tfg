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
    <label><a class="enlace" href="index.php" ><?php echo trad('Inicio', $lang) ?> </a> > <a class="enlace" href="exercises.php" ><?php echo trad('Ejercicios', $lang) ?> </a> > <a class="enlace" href="perform_exercise.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Realizar Ejercicio', $lang) ?></a></label>
    <h2><strong><?php echo $des ?></strong></h2>
    <div class="row mb-5">
        <?php
        $tabla = new Tablas();
        $ejercicioId = $ejer->getEjercicioById($id_ejer);
        $dueño = $ejercicioId['dueño_tablas'];
        $_SESSION["solProf"] = $ejercicioId['solucion'];
        $_SESSION["duenoTablas"] = $ejercicioId['dueño_tablas'];
        $_SESSION["idEjer"] = $ejercicioId['id_ejercicio'];
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
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-exercisesD-tab" data-toggle="tab" href="#nav-new-exercises" role="tab" aria-controls="nav-new-exercises" aria-selected="true"><?php echo trad('Resolver',$lang) ?></a>
                            <a class="nav-item nav-link" id="nav-exercisesE-tab" data-toggle="tab" href="#nav-exercisesE" role="tab" aria-controls="nav-enun-sol" aria-selected="false"><?php echo trad('Resultados',$lang) ?></a>
                            <a class="nav-item nav-link" id="nav-exercises-historico" data-toggle="tab" href="#nav-historico" role="tab" aria-controls="nav-exercise-hist" aria-selected="false"><?php echo trad('Soluciones previas', $lang) ?></a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-exercises" role="tabpanel" aria-labelledby="nav-exercisesD-tab">
                            <div class="col-md-6 p-0 float-right" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">                
                                        <table id="employee" class="table table-striped table-bordered"> 
                                            <thead>
                                                <tr>
                                                    <th style="width:20%; text-align: center"><?php echo trad('Solución', $lang) ?></th>                         
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo '<form action="../handler/validate_exercise.php?exercise=' . $id_ejer . '" method="post">' ?>
                                                <tr>
                                                    <td>
                                                        <?php if (isset($_SESSION["solAlum"])){ ?>
                                                            <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="15" required><?php echo $_SESSION["solAlum"]; ?></textarea>
                                                        <?php } else { ?>
                                                            <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="15" placeholder="<?php echo trad('Escribe la solución aquí...', $lang) ?>" required></textarea>
                                                        <?php } ?>
                                                    </td>

                                                </tr> 
                                            </tbody>
                                        </table>
                                        <button type="submit" id="alert-sol" class="btn btn-primary mt-5 mb-5 pl-5 pr-5 float-right"><?php echo trad('Ejecutar', $lang) ?></button>
                                        <?php echo '</form>'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-3 float-left" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">                
                                        <table id="employee" class="table table-striped-config table-bordered"> 
                                            <thead>
                                                <tr>
                                                    <th style="width:20%; text-align: center; font-size: 12px;"><?php echo trad('Enunciado', $lang) ?></th>                         
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <td style="padding-left: 75px; padding-right: 75px;"> <?php echo $ejercicioId['enunciado']; ?> </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-3 float-left" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">                
                                        <table id="employee_table_hoja" class="table table-striped-config table-bordered"> 
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center"><?php echo trad('Tablas', $lang) ?></th>                         
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $usa = new Usa(); 
                                                    $nombre_tablas = $usa->getNombreById($id_ejer);
                                                    $cont = 0;
                                                    while($nameTable = mysqli_fetch_array($nombre_tablas)){
                                                ?>
                                                <tr>
                                                    <?php 
                                                        $arrayTablas[$cont] = $nameTable['nombre'];
                                                        $cont = $cont + 1;
                                                        $quitar = $nameTable['schema_prof'] . "_";
                                                        $onlyName = explode($quitar, $nameTable['nombre']);
                                                    ?>
                                                    <td class="addFields" data-name="<?php echo $nameTable["nombre"]?>" style="text-align: center"> <?php echo $onlyName[1]; ?> </td>
                                                </tr>    
                                                <?php } ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-3 float-left" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">
                                        <div id="tituloCabe"> <?php echo trad('Campos', $lang) ?></div>               
                                            <div class="col-md-12">
                                                <div class="columnas-tabla" >
                                                    <table id="structure_table" class="">
                                                        <tbody class="body-tablas-style">
                                                                
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="tab-pane fade mt-3 pl-4" id="nav-historico" role="tabpanel" aria-labelledby="nav-exercises-historico">
                            <div id="accordion ">
                                <div class="card pt-4">  
                                    <div class="table-responsive no-buscar">  
                                        <table id="employee_data" class="table table-striped table-bordered">  
                                            <thead>
                                                <tr>
                                                    <th style="width:8%;"><?php echo trad('Nº de intento',$lang) ?></th>
                                                    <th style="width:20%;"><?php echo trad('Fecha',$lang) ?></th>
                                                    <th style="width:8%;"><?php echo trad('Veredicto',$lang) ?></th>
                                                    <th style="width:64%;"><?php echo trad('Solución',$lang) ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaSolucionesPropuesta"> 
                                                <?php 
                                                    /*onclick="activarTabSolucion()"*/
                                                    $sol = new Solucion(); 
                                                    $historico = $sol->getAllEjerciciosByName($id_ejer);
                                                    while($arrayHistorico = mysqli_fetch_array($historico)){
//                                                ?>
                                                    <tr class="solucionPropuesta"> 
                                                        <td> <?php echo $arrayHistorico['intentos']; ?> </td>
                                                        <td> <?php echo $arrayHistorico['fecha']; ?> </td>
                                                        <td> <?php echo $arrayHistorico['veredicto']; ?> </td>
                                                        <td id="sol_propuesta"> <?php echo $arrayHistorico['solucion_propuesta']; ?> </td>
                                                    </tr>    
                                                <?php } ?> 
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
    <?php
    if (isset($_SESSION['msg_solucion'])) {
        echo $_SESSION['msg_solucion'];
        unset($_SESSION['msg_solucion']);
    }
    ?>
</div>
<?php include("footer.php"); ?> 