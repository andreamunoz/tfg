<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a> </label>
    <h2><strong><?php echo trad('Ejercicios',$lang) ?></strong></h2>
    <p><?php echo trad('Texto a añadir aquí...',$lang) ?></p>
    <div id="accordion ">
        <div class="card pt-4">  
            <div class="table-responsive no-buscar">  
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:20%;"><?php echo trad('Nombre Ejercicio',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Profesor',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Nivel',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Tipo',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('N. Intentos',$lang) ?></th>                      
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../inc/ejercicio.php';
                        $ejer = new Ejercicio();
                        include_once '../inc/solucion.php';
                        $sol = new Solucion();
                        include_once '../inc/hoja_ejercicio.php';
                        $hojaejer = new HojaEjercicio();
                        $res= $ejer->getAllNiveles();
                        $resC = $ejer->getAllCategorias();
                        $resP = $ejer->getCreadorEjercicio();
                        if (isset($res) && isset($resC) && isset($resP)) {
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_profe" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todos Profesores </option>";
                            while ($row_profe = mysqli_fetch_array($resP)) {
                                echo "<option value=" . $row_profe['creador_ejercicio'] . ">" . $row_profe['nombre'].' '.$row_profe['apellidos'] . " </option>";
                            }
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todos Niveles </option>";
                            while ($row_nivel = mysqli_fetch_array($res)) {
                                echo "<option value=" . $row_nivel['nivel'] . ">" . $row_nivel['nivel'] . " </option>";
                            }
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todas Categorías </option>";
                            while ($row_tipo = mysqli_fetch_array($resC)) {
                                echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                            }
                            echo '</select>';
                            $result = $ejer->getAllEjerciciosHabilitados();
                            while ($fila = mysqli_fetch_array($result)) {
                                $id = $fila['id_ejercicio'];
                                $user = $_SESSION['user'];
                                $solucion = $sol->getSolEjerciciosByName($id,$user);
                                $numIntentos = $sol->getNumIntentosEjercicio($id,$user);
                                $fila_sol = mysqli_fetch_array($solucion);

                                if ($fila_sol['veredicto'] == '1') { ?>
                                    <tr class="ejercicio_acierto" onclick="location='perform_exercise.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">
                                <?php } else if ($fila_sol['veredicto'] == '0') { ?> 
                                    <tr class="ejercicio_fallo" onclick="location='perform_exercise.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">
                                <?php } else { ?>
                                    <tr class="fondo_blanco" onclick="location='perform_exercise.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">
                                <?php } ?>
                                    <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nombre'] .' '.$fila['apellidos']. '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php if($numIntentos['intentos'] != '') { ?>
                                        <?php echo '<td>' . $numIntentos['intentos'] . '</td>'; ?>     
                                    <?php } else { ?>
                                        <?php echo '<td>0</td>'; }?>
                                    </tr>  
                            <?php } 
                        } ?>
                    </tbody>
                </table>
            </div>  
        </div> 
    </div>
</div>
<?php include("footer.php"); ?>


