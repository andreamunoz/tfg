<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
     include_once '../inc/hoja_ejercicio.php';
     $hojaparameter = $_GET['hoja'];
     $hojaejer = new HojaEjercicio();
     $nombreHoja = $hojaejer->getHojaById($hojaparameter);
      ?>
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a>  > <a class="enlance" href="sheet_exercise.php?hoja=<?php echo $hojaparameter ?>" ><?php echo $nombreHoja ?></a></label>
    <h2><strong><?php echo $nombreHoja ?></strong></h2>
    <p><?php echo trad('Textooooo aquí........',$lang) ?></p>
    <div class="row pt-2 pb-4">
        <div class="col-md-3  offset-9">
            <div class="progress">
                <?php
                $res = $hojaejer->getIdByName($hojaparameter);
                $idHoja = $res['id_hoja'];
                include_once '../inc/esta_contenido.php';
                $estaCon = new EstaContenido();
                $r = $estaCon->getNumEjercicios($idHoja);

                include_once '../inc/estadisticas.php';
                $contenido = new Estadisticas();
                $rCon = $contenido->getPorcentajeAciertos($idHoja);

                if ($rCon['veredicto'] > '0') {
                    $resultadoDec = ($rCon['veredicto'] / $r['num']) * 100;
                    $resultado = round($resultadoDec);
                    echo '<div class="progress-bar" role="progressbar" aria-valuenow="70"
					  aria-valuemin="0" aria-valuemax="100" style="width:' . $resultado . '%"><p>' . $resultado . '%</p>
					  </div>';
                } else {
                    echo '<div class="progress-bar" role="progressbar" aria-valuenow="0"
					  aria-valuemin="0" aria-valuemax="100" style="width:0%"><p>0%</p>
					  </div>';
                }
                ?>
            </div> 
        </div>
    </div>			
    <div id="accordion">
        <div class="card">
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:5%;"></th>
                            <th style="width:20%;"><?php echo trad('Nombre Ejercicio',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Nivel',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Tipo',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Profesor',$lang) ?></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../inc/ejercicio.php';
                        $ejer = new HojaEjercicio();
                        $result = $ejer->getHojasYEjerciciosById($hojaparameter);
                        include_once '../inc/solucion.php';
                        $sol = new Solucion();
                        while ($fila = mysqli_fetch_array($result)) {
                            ?>

                            <?php
                            $id = $fila['id_ejercicio'];
                            $user = $_SESSION['user'];
                            $solucion = $sol->getSolEjerciciosByName($id,$user);                 
                            $fila_sol = mysqli_fetch_array($solucion);
                            if ($fila_sol['veredicto'] == '1') {
                                ?>
                                <tr>
                                <td><i class="fas fa-check"></i></td>
                                <?php } else if ($fila_sol['veredicto'] == '0') { ?>
                                <td><i class="fas fa-times"></i></td>
                                <?php } else { ?>

                                <td><i class="fas fa-question"></i></td>  
                                <?php } ?>  	
                                <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                
                                <?php echo '<td><a class="btn btn-primary pl-5 pr-5" href="perform_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Realizar</a>';
                                ?> 
                                <?php if ($fila_sol['intentos'] > 0)
                                        echo '<a class="btn btn-secundary pl-5 pr-5" href="show_intent_exercise.php?hoja='.$hojaparameter.'&exercise=' . $fila['id_ejercicio'] . '">Ver Intentos</a>';
                                ?>
                                <?php echo '</td>'; ?>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>