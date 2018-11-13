<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Hoja de Ejercicios',$lang) ?></strong></h2>
    <p><?php echo trad('Texto a añadir aquí...',$lang) ?></p>  
    <div id="accordion ">
        <div class="card pt-4" >  
            <div class="table-responsive no-buscar">  
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:20%;"><?php echo trad('Nombre Hoja',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Nombre Profesor',$lang) ?></th>
                            <th style="width: 15%"><?php echo trad('N. Ejercicios',$lang) ?></th>
                            <th style="width: 20%"><?php echo trad('N. Ejercicios Resueltos',$lang) ?></th>
                            <th style="width: 20%"><?php echo trad('N. Ejercicios Intentados',$lang) ?></th>                          
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                        include_once '../inc/hoja_ejercicio.php';
                        include_once '../inc/esta_contenido.php';
                        $hojaejer = new HojaEjercicio();
                        $res = $hojaejer->getCreadorHojas();
                        if (isset($res)) {
                            echo '<select name="lista_hoja" class="custom-select form-control-sm select_profe" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todos Profesores </option>";
                            while ($row_hoja = mysqli_fetch_array($res)) {
                                echo "<option value=" . $row_hoja['creador_hoja'] . ">" . $row_hoja['nombre'].' '. $row_hoja['apellidos'] . " </option>";
                            }
                            echo '</select>';
                            $result = $hojaejer->getAllHojas();
                            while ($fila_hoja = mysqli_fetch_array($result)) {
                                ?>

                                <tr class="accordion-toggle fondo_blanco" id="show-accordion" onclick="location='sheet_exercise.php?hoja=<?php echo $fila_hoja['id_hoja']; ?>'" >
                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre_hoja'] . '</td>'; ?>

                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre'] . ' ' . $fila_hoja['apellidos'] . '</td>'; ?>
                                    <?php
                                    $number = new EstaContenido();
                                    $id_hoja = $fila_hoja['id_hoja'];
                                    $row_number = $number->getNumberEjerciciosByHoja($id_hoja);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_number["COUNT(id_ejercicio)"] . '</td>';
                                    $row_result = $number->getNumberEjerciciosResueltosBien($id_hoja, $_SESSION['user']);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_result["COUNT(DISTINCT(ec.id_ejercicio))"] . '</td>';
                                    $row_intent = $number->getNumberEjerciciosIntentados($id_hoja, $_SESSION['user']);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_intent["COUNT(DISTINCT(ec.id_ejercicio))"] . '</td>';
                                    
                                    ?>
                                   
                                </tr>
                            <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
