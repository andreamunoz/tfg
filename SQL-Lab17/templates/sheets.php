<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Hoja de Ejercicios',$lang) ?></strong></h2>
    <p><?php echo trad('Texto a añadir aquí...',$lang) ?></p>    
    <div id="accordion ">
        <div class="card pt-4" >  
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:30%;"><?php echo trad('Nombre Hoja',$lang) ?></th>
                            <th style="width:30%;"><?php echo trad('Nombre Profesor',$lang) ?></th>
                            <th style="width: 60%"><?php echo trad('N. Ejercicios',$lang) ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                        include_once '../inc/hoja_ejercicio.php';
                        include_once '../inc/esta_contenido.php';
                        $hojaejer = new HojaEjercicio();
                        $result = $hojaejer->getAllHojas();
                        if (isset($result)) {

                            while ($fila_hoja = mysqli_fetch_array($result)) {
                                ?>

                                <tr class="accordion-toggle" id="show-accordion" >
                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre_hoja'] . '</td>'; ?>

                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['creador_hoja'] . '</td>'; ?>
                                    <?php
                                    $number = new EstaContenido();
                                    $id_hoja = $fila_hoja['id_hoja'];
                                    $row_number = $number->getNumberEjerciciosByHoja($id_hoja);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_number["COUNT(id_ejercicio)"] . '</td>';
                                    ?>
                                    <?php echo '<td><a class="btn btn-primary pl-5 pr-5" href="sheet_exercise.php?hoja=' . $fila_hoja['id_hoja'] . '">Ver Hoja</a></td>'; ?>
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
