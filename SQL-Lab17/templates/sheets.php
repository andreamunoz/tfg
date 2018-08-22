<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlance" href="index.php" >Inicio </a> > <a class="enlance" href="sheets.php" > Hoja de Ejercicios</a></label>
    <h2><strong>Hoja de Ejercicios</strong></h2>
    <p>Texto a añadir aquí...</p>
    <div class="hrr mb-5"></div>     
    <div id="accordion ">
        <div class="card" >  
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:30%;">Nombre Hoja</th>
                            <th style="width:30%;">Nombre Profesor</th>
                            <th style="width: 60%">N. Ejercicios</th>
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
                                    <?php echo '<td><a class="text-tabla" href="sheet_exercise.php?hoja=' . $fila_hoja['id_hoja'] . '">+Info</a></td>'; ?>
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
