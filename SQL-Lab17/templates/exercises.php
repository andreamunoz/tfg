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
                            <th style="width:39%;"><?php echo trad('Descripción',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Profesor',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Nivel',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Tipo',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('N. Intentos',$lang) ?></th>                      
                            <th style="width:1%;"></th>
                            <!-- <th style="width:20%;"><?php //echo trad('Descripción',$lang) ?></th>
                            <th style="width:15%;"><?php //echo trad('Profesor',$lang) ?></th>
                            <th style="width:15%;"><?php //echo trad('Nivel',$lang) ?></th>
                            <th style="width:20%;"><?php //echo trad('Tipo',$lang) ?></th>
                            <th style="width:10%;"><?php //echo trad('N. Intentos',$lang) ?></th>                      
                            <th style="width:10%;"><?php //echo trad('Resultado',$lang) ?></th> -->
                        </tr>
                    </thead>
                    <tbody id="tablaEjerResolver">
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
                            echo "<option name='' apellido1='' apellido2=''>Todos Profesores </option>";
                            while ($row_profe = mysqli_fetch_array($resP)) {
                                $apellidos = explode(" ",$row_profe['apellidos']);
                                echo "<option name=". $row_profe['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_profe['nombre'].' '.$row_profe['apellidos'] . " </option>";
                            }
                            echo '</select>';
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
                            $result = $ejer->getAllEjerciciosHabilitados();
                            while ($fila = mysqli_fetch_array($result)) {
                                $id = $fila['id_ejercicio'];
                                $user = $_SESSION['user'];
                                $solucion = $sol->getSolEjerciciosByName($id,$user);
                                $resultadoIntentosVeredicto = $sol->getInfoVeredictoParaTabla($id,$user);
                                $fila_sol = mysqli_fetch_array($solucion); ?>
                                    
                                <tr id="resolverEjer" class="fondo_blanco"  data-number=<?php echo $fila['id_ejercicio']; ?> > 
                                <?php
                                    echo '<td>' . $fila['descripcion'] . '</td>'; 
                                    echo '<td>' . $fila['nombre'] .' '.$fila['apellidos']. '</td>'; 
                                    echo '<td>' . $fila['nivel'] . '</td>'; 
                                    echo '<td>' . $fila['tipo'] . '</td>'; 
                                    if($resultadoIntentosVeredicto[0] != '') {
                                        echo '<td>' . $resultadoIntentosVeredicto[0] . '</td>'; 
                                        if($resultadoIntentosVeredicto[1] == '1') {
                                            echo '<td style="background-color: green"></td>';
                                            //echo '<td>'. trad('Acierto',$lang) .'</td>';
                                        }else{
                                            echo '<td style="background-color: red"></td>';
                                            //echo '<td>'. trad('Fallo',$lang) .'</td>';
                                        }                                    
                                    } else { 
                                        echo '<td>0</td><td style="background-color: grey"></td>';
                                        //echo '<td>0</td><td>' . trad('No realizado',$lang) .'</td>'; 
                                    }
                                ?>
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


