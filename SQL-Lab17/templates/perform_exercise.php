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
    <label><a class="enlace" href="index.php" ><?php echo trad('Inicio', $lang) ?> </a> > <a class="enlace" href="exercises.php" ><?php echo trad('Ejercicios', $lang) ?> </a> > <a class="enlace" href="perform_exercise.php?exercise=<?php echo $id_ejer ?>" > <?php echo trad('Realizar Ejercicio', $lang) ?></a></label>
    <h2><strong><?php echo $des ?></strong></h2>
    <div class="row mb-5">
        <?php
        $tabla = new Tablas();
        $ejercicioId = $ejer->getEjercicioById($id_ejer);
        $dueño = $ejercicioId['dueño_tablas'];
        $tab = $tabla->getTablasByProfesor($dueño);
        ?>
        <div class="col-md-10">
            <p><?php echo trad('Resuelve el ejercicio según el enunciado propuesto por el profesor.', $lang) ?></p>
        </div>
        <div class="col-md-2 p-0">

        </div>
    </div>  
    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">                  
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-exercisesD-tab" data-toggle="tab" href="#nav-new-exercises" role="tab" aria-controls="nav-new-exercises" aria-selected="true"><?php echo trad('Resolver',$lang) ?></a>
                            <a class="nav-item nav-link" id="nav-exercisesE-tab" data-toggle="tab" href="#nav-exercisesE" role="tab" aria-controls="nav-enun-sol" aria-selected="false"><?php echo trad('Resultados',$lang) ?></a>
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
                                                        <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="18" placeholder="<?php echo trad('Escribe la solución aquí...', $lang) ?>" required></textarea>
                                                    </td>

                                                </tr>                       
                                                <?php echo '</form>'; ?>
                                            </tbody>
                                        </table>
                                        <button type="submit" id="alert-sol" class="btn btn-primary mt-5 mb-5 pl-5 pr-5 float-right"><?php echo trad('Ejecutar', $lang) ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-3" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">                
                                        <table id="employee" class="table table-striped table-bordered"> 
                                            <thead>
                                                <tr>
                                                    <th style="width:20%; text-align: center"><?php echo trad('Enunciado', $lang) ?></th>                         
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <td > <?php echo $ejercicioId['enunciado']; ?> </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade mt-3 pl-4" id="nav-exercisesE" role="tabpanel" aria-labelledby="nav-exercisesE-tab">
                            <div class="col-md-6 pl-0 pr-3" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">
                                        <p><?php echo trad('Solución Profesor', $lang) ?></p>
                                        <table id="employee" class="table table-striped table-bordered"> 
                                            <?php 
                                                include_once '../inc/ejercicio.php';
                                                $ejer = new Ejercicio();
                                                include_once '../inc/solucion.php';
                                                $sol = new Solucion(); 
                                                $fieldsProf = $ejer->getFieldsProfesor($id_ejer);
                                                $resPro = $fieldsProf;
                                            ?>
                                            <thead>                                             
                                                <tr>
                                                    <?php if($fieldsProf != '') { $cont=0;?>
                                                    <?php while($fields = mysqli_fetch_field($fieldsProf)){ ?>
                                                        <th style="width:20%; text-align: center"><?php echo $fields->name ?></th>                         
                                                    <?php $arrayFileds[$cont] = $fields->name; $cont++; } }else {?>
                                                        <th style="width:20%; text-align: center">No tiene datos</th> 
                                                    <?php } $contF = $cont;?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($resPro != '') { $cont=0;?>
                                                <?php while($f = mysqli_fetch_array($resPro)){ ?>
                                                <tr>   
                                                    <?php while($contF > $cont){ ?>
                                                    <td><?php echo $f[$arrayFileds[$cont]]; ?></td>
                                                    <?php $cont++; } ?>
                                                </tr>                                               
                                                <?php $cont=0;} }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-3" id="accordion ">
                                <div class="card">  
                                    <div class="table-responsive">
                                        <p><?php echo trad('Solución Alumno', $lang) ?></p>
                                        <table id="employee" class="table table-striped table-bordered"> 
                                            <?php 
                                                include_once '../inc/ejercicio.php';
                                                $ejer = new Ejercicio();
                                                include_once '../inc/solucion.php';
                                                $sol = new Solucion(); 
                                                $fieldsAlum = $ejer->getFieldsProfesor($id_ejer);
                                                $resPro = $fieldsAlum;
                                            ?>
                                            <thead>                                             
                                                <tr>
                                                    <?php if($fieldsAlum != '') { $cont=0;?>
                                                    <?php while($fields = mysqli_fetch_field($fieldsAlum)){ ?>
                                                        <th style="width:20%; text-align: center"><?php echo $fields->name ?></th>                         
                                                    <?php $arrayFileds[$cont] = $fields->name; $cont++; } }else {?>
                                                        <th style="width:20%; text-align: center">No tiene datos</th> 
                                                    <?php } $contA = $cont;?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($resPro != '') { $cont=0;?>
                                                <?php while($f = mysqli_fetch_array($resPro)){ ?>
                                                <tr>   
                                                    <?php while($contA > $cont){ ?>
                                                    <td><?php echo $f[$arrayFileds[$cont]]; ?></td>
                                                    <?php $cont++; } ?>
                                                </tr>                                               
                                                <?php $cont=0;} }?>
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