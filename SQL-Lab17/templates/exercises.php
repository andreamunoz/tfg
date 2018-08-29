<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlance" href="index.php" >Inicio </a> > <a class="enlance" href="exercises.php" > Ejercicios</a> </label>
    <h2><strong>Ejercicios</strong></h2>
    <p>Texto a añadir aquí...</p>
    <div id="accordion ">
        <div class="card pt-4">  
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:5%;"></th>
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
                        $ejer = new Ejercicio();
                        include_once '../inc/solucion.php';
                        $sol = new Solucion();
                        $result = $ejer->getAllEjerciciosHabilitados();
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
                                <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>

                                <?php echo '<td><a class="btn btn-primary pl-5 pr-5" href="perform_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Realizar</a>';
                                ?> 
                                <?php if ($fila_sol['intentos'] > 0)
                                        echo '<a class="btn btn-secundary pl-5 pr-5" href="shows_intent_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Ver Intentos</a>';
                                ?>
                                <?php echo '</td>'; ?>
                            </tr>
    <?php
}
?>

                    </tbody>
                </table>
            </div>  
        </div> 
    </div>
</div>
<?php include("footer.php"); ?>


