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
                <a class="btn btn-primary pl-4 pr-4" href="files/sheet_pdf.php?sheet=<?php echo $hojaparameter; ?> "><?php echo trad('DESCARGAR',$lang) ?><i style="font-size:25px; vertical-align: middle;" class="fas fa-file-pdf pl-2"></i></a>
            </div>
        </div>
    </div>
    <div id="accordion">
        <div class="card">
            <div class="table-responsive no-buscar">  
                <table id="employee_data" class="table table-striped-conf table-bordered">
                    <thead>
                        <tr>
                            <th style="width:20%;"><?php echo trad('Descripción',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Profesor',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Nivel',$lang) ?></th>
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
                            
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_profe" title="Selecciona profesor" id="select_hoja">';
                            echo "<option name='' apellido1='' apellido2=''>Todos Profesores </option>";
                            while ($row_profe = mysqli_fetch_array($resP)) {
                                $apellidos = explode(" ",$row_profe['apellidos']);
                                echo "<option name=". $row_profe['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_profe['nombre'].' '. $row_profe['apellidos']. " </option>";
                            }
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona nivel" id="select_hoja">';
                                echo "<option value=''>Todos Niveles </option>";
                                echo "<option value='Principiante'>Principiante </option>";
                                echo "<option value='Intermedio'>Intermedio </option>";
                                echo "<option value='Avanzado'>Avanzado </option>";
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona categoría" id="select_hoja">';
                            echo "<option value=" . $row_tipo['tipo'] . ">Todas Categorías </option>";
                            while ($row_tipo = mysqli_fetch_array($resC)) {
                                echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                            }
                            echo '</select>';
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
                                        echo '<a class="pr-5" href="configuration_show_intent_exercise.php?hoja='.$hojaparameter.'&exercise=' . $fila['id_ejercicio'] . '"><i class="fas fa-info" style="color:black; opacity:0.9;"></i></a>';
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