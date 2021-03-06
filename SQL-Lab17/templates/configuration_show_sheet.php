<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
     include_once '../inc/hoja_ejercicio.php';
     $hojaparameter = $_GET['hoja'];
     $hojaejer = new HojaEjercicio();
     $nombreHoja = $hojaejer->getHojaById($hojaparameter);
     $_SESSION['HOJA_EXE']= 0;
     $_SESSION['HOJA_VISTA']=$hojaparameter;
     $_SESSION['HOJA_VISTA_NOMBRE']=$nombreHoja;
      ?>
    <label><a class="enlance" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlance" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a>  > <a class="enlance" href="configuration_show_sheet.php?hoja=<?php echo $hojaparameter ?>" ><?php echo $nombreHoja ?></a></label>
    <h2><strong><?php echo $nombreHoja ?></strong></h2>
    <!-- <p><?php //echo trad('Textooooo aquí........',$lang) ?></p> -->
    <div class="row mb-150">
        <div class="col-md-12">
            <div class="text-right pl-5">
                <a class="btn btn-primary pl-4 pr-4" href="files/sheet_pdf.php?sheet=<?php echo $hojaparameter; ?> " target="_blank"><?php echo trad('DESCARGAR',$lang) ?><i style="font-size:25px; vertical-align: middle;" class="fas fa-file-pdf pl-2"></i></a>
            </div>
        </div>
    </div>
    <div id="accordion">
        <div class="card">
            <div class="table-responsive no-buscar">  
                <table id="employee_data" class="table table-striped-conf table-bordered">
                    <thead>
                        <tr>
                            <th style="width:40%;"><?php echo trad('Descripción',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Profesor',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Nivel',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Tipo',$lang) ?></th>
                            <th></th>

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
                            
                            echo '<select name="verhoja" class="custom-select form-control-sm mr-3 select_profesor" title="Selecciona profesor" id="select_pro">';
                            echo "<option value='' >Todos Profesores </option>";
                            while ($row_profe = mysqli_fetch_array($resP)) {
//                                $apellidos = explode(" ",$row_profe['apellidos']);
//                                echo "<option name=". $row_profe['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_profe['nombre'].' '. $row_profe['apellidos']. " </option>";
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
                                
                                if($_SESSION['select_p_verh'] == $nombreCompu){
                                    echo "<option value=" . $nombreCompu . " selected>" . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                                }else {
                                    echo "<option value=" . $nombreCompu . " > " . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                                }
                                
                            }
                            echo '</select>';
                            echo '<select name="verhoja" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona nivel" id="select_niv">';
                             
                            if($_SESSION['select_n_verh'] == ''){
                                echo "<option value='' selected>Todos Niveles </option>";  
                                echo "<option value='Principiante'> Principiante </option>";
                                echo "<option value='Intermedio'> Intermedio </option>";
                                echo "<option value='Avanzado'> Avanzado </option>";
                            }if($_SESSION['select_n_verh'] == 'Principiante'){
                                echo "<option value=''>Todos Niveles </option>";  
                                echo "<option value='Principiante' selected> Principiante </option>";
                                echo "<option value='Intermedio'> Intermedio </option>";
                                echo "<option value='Avanzado'> Avanzado </option>";
                            }if($_SESSION['select_n_verh'] == 'Intermedio'){  
                                echo "<option value=''>Todos Niveles </option>";  
                                echo "<option value='Principiante'> Principiante </option>";
                                echo "<option value='Intermedio' selected> Intermedio </option>";
                                echo "<option value='Avanzado'> Avanzado </option>";
                            }if($_SESSION['select_n_verh'] == 'Avanzado'){ 
                                echo "<option value=''>Todos Niveles </option>";  
                                echo "<option value='Principiante'> Principiante </option>";
                                echo "<option value='Intermedio'> Intermedio </option>";
                                echo "<option value='Avanzado' selected> Avanzado </option>";
                            } 
                            echo '</select>';
                            echo '<select name="verhoja" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona categoría" id="select_tip">';
                            echo "<option value='' >Todas Categorías </option>";
                            while ($row_tipo = mysqli_fetch_array($resC)) {
                                if($_SESSION['select_t_verh'] == $row_tipo['tipo'] ){
                                    echo "<option value=" . $row_tipo['tipo'] . " selected>" . $row_tipo['tipo'] . " </option>";
                                }
                                else{
                                    echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                                }
                            }
                            echo '</select>';
                            echo '<select name="verhoja" class="custom-select form-control-sm  select_cabecera display-none" title="Selecciona cabecera" id="select_cab">';
                                echo "<option value=".$_SESSION['value_cab_verh']."> ".$_SESSION['select_cab_verh']." </option>";
                            echo '</select>';
                        if($_SESSION['showNumber_verh'] != ""){
                        ?>
                            <p class="showNumberEntries display-none"><?php echo $_SESSION['showNumber_verh'] ?></p>
                        <?php } else { ?>
                            <p class="showNumberEntries display-none">10</p>
                        <?php } 
                        $result = $hojaejer->getHojasYEjerciciosById($hojaparameter);
                        
                        while ($fila = mysqli_fetch_array($result)) {
                            ?>

                                <?php
                                $id = $fila['id_ejercicio'];
                                $solucion = $sol->getAllEjerciciosByName($id);

                                $fila_sol = mysqli_fetch_array($solucion);
                                ?> 
                            <tr class="fondo_blanco" onclick="location='configuration_show_exercises.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">
                                <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>

                                <?php echo '<td style="text-align: right;"><a  href="perform_exercise.php?exercise='.$fila['id_ejercicio'].'"></a>';
                                ?> 
                                <?php if ($fila_sol['intentos'] > 0)
                                        //echo '<a class="pr-5" href="configuration_show_intent_exercise.php?hoja='.$hojaparameter.'&exercise=' . $fila['id_ejercicio'] . '"><i class="fas fa-info" style="color:black; opacity:0.9;"></i></a>';
                                ?>
                                <?php echo '</td>'; ?>

                            </tr>
                        <?php } }?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>