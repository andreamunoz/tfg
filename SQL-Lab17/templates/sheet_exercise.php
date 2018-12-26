<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <?php
     include_once '../inc/hoja_ejercicio.php';
     $hojaparameter = $_GET['hoja'];
     $hojaejer = new HojaEjercicio();
     $nombreHoja = $hojaejer->getHojaById($hojaparameter);
     $nombreProfesor = $hojaejer->getCreadorHojaById($hojaparameter);
      ?>
    <label><a class="enlance" href="index.php" ><?php echo trad('Inicio',$lang) ?> </a> > <a class="enlance" href="sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a>  > <a class="enlance" href="sheet_exercise.php?hoja=<?php echo $hojaparameter ?>" ><?php echo $nombreHoja ?></a></label>
    <h2><strong><?php echo $nombreHoja ?> | Profesor ( <?php echo $nombreProfesor['nombre'] .' '. $nombreProfesor['apellidos']; ?> )</strong></h2>
    <div class="row mb-150">
        <div class="col-md-12">
            <div class="text-right pl-5">
                <a class="btn btn-primary pl-4 pr-4" href="files/sheet_pdf.php?sheet=<?php echo $hojaparameter; ?> "><?php echo trad('DESCARGAR',$lang) ?><i style="font-size:25px; vertical-align: middle;" class="fas fa-file-pdf pl-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row pt-2 pb-4">
        <div class="col-md-3  offset-9">
            <?php
                $res = $hojaejer->getIdByName($hojaparameter);
                $idHoja = $_GET['hoja'];
                include_once '../inc/esta_contenido.php';
                $estaCon = new EstaContenido();
                $r = $estaCon->getNumEjercicios($idHoja);

                include_once '../inc/estadisticas.php';
                $contenido = new Estadisticas();
                $rCon = $contenido->getPorcentajeAciertos($idHoja);
                if ($rCon['veredicto'] > '0') {
                    $resultadoDec = ($rCon['veredicto'] / $r) * 100;
                    $resultado = round($resultadoDec);
             ?>
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow='<?php echo $num ?>' aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $resultado ?>%"><span><?php echo $resultado ?>%</span></div>
            <?php } else { ?>
            <div class="progress">
                <div class="progress-bar progress-bar-none" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"><span>0%</span></div>
            <?php } ?>
            </div> 
        </div>
    </div>			
    <div id="accordion">
        <div class="card">
            <div class="table-responsive no-buscar">  
                <table id="employee_data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:15%;"><?php echo trad('Nombre Ejercicio',$lang) ?></th>
                            <th style="width:5%;"></th>
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
                        $resP = $hojaejer->getCreadorHojas();
                        if (isset($res) && isset($resC) && isset($resP)) {
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todos Niveles </option>";
                                echo "<option value='Principiante'>Principiante </option>";
                                echo "<option value='Intermedio'>Intermedio </option>";
                                echo "<option value='Avanzado'>Avanzado </option>";
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todas Categorías </option>";
                            while ($row_tipo = mysqli_fetch_array($resC)) {
                                echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                            }
                            echo '</select>';
                        $result = $hojaejer->getHojasYEjerciciosById($hojaparameter);
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
                                <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                <?php echo '<td></td>'; ?>    
                                <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                <?php if($numIntentos['intentos'] != '') { ?>
                                    <?php echo '<td>' . $numIntentos['intentos'] . '</td>'; ?>     
                                <?php } else { ?>
                                    <?php echo '<td>0</td>'; }?>
                                </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>