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
    <label><a class="enlance" href="configuration.php" >Configuración </a> > <a class="enlance" href="configuration_sheets.php" > Hoja de Ejercicios</a>  > <a class="enlance" href="configuration_show_sheet.php?hoja=<?php echo $hojaparameter ?>" ><?php echo $nombreHoja ?></a></label>
    <h2><strong><?php echo $nombreHoja ?></strong></h2>
    <p>Textooooo aquí........</p>
    <div class="hrr mt-3 mb-5"></div>			
    <div id="accordion">
        <div class="card">
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:20%;">Nombre Ejercicio</th>
                            <th style="width:10%;">Nivel</th>
                            <th style="width:20%;">Tipo</th>
                            <th style="width:15%;">Profesor</th>
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
                                <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>

                                <?php echo '<td><a class="btn btn-primary pl-5 pr-5" href="perform_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Ver ejercicio</a>';
                                ?> 
                                <?php if ($fila_sol['intentos'] > 0)
                                        echo '<a class="btn btn-secundary pl-5 pr-5" href="configuration_show_intent_exercise.php?hoja='.$hojaparameter.'&exercise=' . $fila['id_ejercicio'] . '">Ver Intentos</a>';
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