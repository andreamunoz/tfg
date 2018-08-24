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
                            <th style="width:20%;">Ultima Modificación</th>
                            <th style="width:10%;">Intentos</th>
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

                                <?php
                                if ($fila_sol['fecha'])
                                    echo '<td>' . $fila_sol['fecha'] . '</td>';
                                else
                                    echo '<td>No tiene última modificación</td>';
                                ?>
                                <?php
                                if ($fila_sol['intentos'])
                                    echo '<td>' . $fila_sol['intentos'] . '</td>';
                                else
                                    echo '<td>0</td>';
                                ?>

                                <?php echo '<td><a class="text-tabla" href="perform_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Ver</a></td>'; ?>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>