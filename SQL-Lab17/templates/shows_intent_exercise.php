<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
     include_once '../inc/ejercicio.php';
     $id_ejercicio = $_GET['exercise'];
     $ejer = new Ejercicio();
     $descrip = $ejer->getNameById($id_ejercicio);
      ?>
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a>  > <a class="enlance" href="shows_intent_exercise.php?exercise=<?php echo $id_ejercicio  ?>" ><?php echo $descrip['descripcion']  ?></a></label>
    <h2><strong><?php echo trad('Lista de Intentos',$lang) ?> | <?php echo $descrip['descripcion'] ?></strong></h2>
    <p><?php echo trad('Textooooo aquí........',$lang) ?></p>			
    <div id="accordion">
        <div class="card pt-4">
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:5%;"></th>
                            <th style="width:20%;"><?php echo trad('Nombre Ejercicio',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Ultima Modificación',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Intentos',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Solución',$lang) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../inc/solucion.php';
                        $sol = new Solucion();
                        $user = $_SESSION['user'];
                        $solucion = $sol->getSolEjerciciosByName($id_ejercicio, $user);
                        $contador = 0;
                        while ($fila_sol = mysqli_fetch_array($solucion)) {
              
                            if ($fila_sol['veredicto'] == '1') {
                                ?>
                                <tr>
                                <td><i class="fas fa-check"></i></td>
                                <?php } else if ($fila_sol['veredicto'] == '0') { ?>
                                <td><i class="fas fa-times"></i></td>
                                <?php } else { ?>

                                <td><i class="fas fa-question"></i></td>  
                                <?php } ?>  	
                                <?php echo '<td>' . $descrip['descripcion'] . '</td>'; ?>

                                <?php
                                if ($fila_sol['fecha'])
                                    echo '<td>' . $fila_sol['fecha'] . '</td>';
                                else
                                    echo '<td>No tiene última modificación</td>';
                                ?>
                                <?php
                                if ($fila_sol['intentos'])
                                    echo '<td >' . $fila_sol['intentos'] . '</td>';
                                else
                                    echo '<td>0</td>';
                                ?> 
                                
                                <?php echo '<td >'
                                            . ' <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#modalEliminarHoja'.$contador.'"> Ver Solución              
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEliminarHoja'.$contador.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="mt-4 pl-5">Solución propuesta</h2>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel_blanco.svg"/></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">                                              
                                                                <h5 class="pl-5 mt-3 mb-3">'. $fila_sol['solucion_propuesta'] . '</h5>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>'                                   
                                            . '</td>'; 
                                    ?>
                            </tr>
                        <?php 
                            $contador = $contador + 1; 
                        } ?>

                    </tbody>
                </table>
                <?php echo '<a class="btn btn-primary pl-5 pr-5" href="perform_exercise.php?exercise=' . $id_ejercicio. '">Volver a Realizar</a>';?> 
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>