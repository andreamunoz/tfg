<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php 
//variables-sesion: exercises
unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t']); unset($_SESSION['value_cab']); unset($_SESSION['select_cab']); $_SESSION['showNumber']=""; 
//variables-sesion: ver hoja
unset($_SESSION['select_p_verh']); unset($_SESSION['select_n_verh']); unset($_SESSION['select_t_verh']); unset($_SESSION['value_cab_verh']); unset($_SESSION['select_cab_verh']); $_SESSION['showNumber_verh']="";
?>
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
                            echo '<select name="hoja" class="custom-select form-control-sm select_profesor" title="Selecciona profesor" id="select_pro">';
//                            echo "<option name='' apellido1='' apellido2=''>Todos Profesores </option>";
                            echo "<option value='' >Todos Profesores </option>";
                            while ($row_profe = mysqli_fetch_array($res)) {
//                                $apellidos = explode(" ",$row_hoja['apellidos']);
//                                echo "<option name=". $row_hoja['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_hoja['nombre'].' '. $row_hoja['apellidos']. " </option>";
                            
                                $nombre = explode(" ",$row_profe['nombre']);
                                $apellidos = explode(" ",$row_profe['apellidos']);
                                if ($nombre[1] == '' && $apellidos[1]=='')
                                    $nombreCompu = "$nombre[0]-$apellidos[0]";
                                else if($nombre[1] == '')
                                    $nombreCompu = "$nombre[0]-$apellidos[0]-$apellidos[1]";
                                else if($nombre[1] != '' && $apellidos[1]=='')
                                    $nombreCompu = "$nombre[0]-$nombre[1]-$apellidos[0]";
                                else
                                    $nombreCompu = "$nombre[0]-$nombre[1]-$apellidos[0]-$apellidos[1]";
                                
                                if($_SESSION['select_p_h'] == $nombreCompu){
                                    echo "<option value=" . $nombreCompu . " selected>" . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                                }else {
                                    echo "<option value=" . $nombreCompu . " > " . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                                }
                            }
                            echo '</select>';
                            echo '<select name="hoja" class="custom-select form-control-sm  select_cabecera display-none" title="Selecciona cabecera" id="select_cab">';
                                echo "<option value=".$_SESSION['value_cab_h']."> ".$_SESSION['select_cab_h']." </option>";
                            echo '</select>';
                            if($_SESSION["showNumber_h"] != ''){
                        ?>
                            <p class="showNumberEntries display-none"><?php echo $_SESSION['showNumber_h'] ?></p>
                        <?php } else { ?>
                            <p class="showNumberEntries display-none">10</p>
                        <?php }  
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
