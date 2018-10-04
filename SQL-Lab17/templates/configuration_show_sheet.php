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
    <label><a class="enlance" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlance" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a>  > <a class="enlance" href="configuration_show_sheet.php?hoja=<?php echo $hojaparameter ?>" ><?php echo $nombreHoja ?></a></label>
    <h2><strong><?php echo $nombreHoja ?></strong></h2>
    <p><?php echo trad('Textooooo aquí........',$lang) ?></p>		
    <div id="accordion">
        <div class="card">
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
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
                                $solucion = $sol->getAllEjerciciosByName($id);

                                $fila_sol = mysqli_fetch_array($solucion);
                                ?> 
                            <tr class="fondo_blanco" onclick="location='perform_exercise.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">
                                <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>

                                <?php echo '<td style="text-align: right;"><a  href="perform_exercise.php?exercise='.$fila['id_ejercicio'].'"></a>';
                                ?> 
                                <?php if ($fila_sol['intentos'] > 0)
                                        echo '<a class="pr-5" href="configuration_show_intent_exercise.php?hoja='.$hojaparameter.'&exercise=' . $fila['id_ejercicio'] . '"><i class="fas fa-info" style="color:black; opacity:0.9;"></i></a>';
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