<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php 
$_SESSION['HOJA_EXE']= 1; 
//variables-sesion: hoja
unset($_SESSION['select_p_h']); unset($_SESSION['select_cab_h']); unset($_SESSION['value_cab_h']); $_SESSION['showNumber_h']=""; 
//variables-sesion: ver hoja
unset($_SESSION['select_p_verh']); unset($_SESSION['select_n_verh']); unset($_SESSION['select_t_verh']); unset($_SESSION['value_cab_verh']); unset($_SESSION['select_cab_verh']); $_SESSION['showNumber_verh']="";
unset($_SESSION['perform_tabla']);
?>
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
                            echo '<select name="exercises" class="custom-select form-control-sm mr-3 select_profesor" title="Selecciona profesor" id="select_pro">';
                            echo "<option value='' >Todos Profesores </option>";  
                            while ($row_profe = mysqli_fetch_array($resP)) {
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
                                
                                if($_SESSION['select_p'] == $nombreCompu){
                                    echo "<option value=" . $nombreCompu . " selected>" . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                                }else {
                                    echo "<option value=" . $nombreCompu . " > " . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                                }
                            }
                            echo '</select>';
                            echo '<select name="exercises" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona nivel" id="select_niv">';
                             
                            if($_SESSION['select_n'] == ''){
                                echo "<option value='' selected>Todos Niveles </option>";  
                                echo "<option value='Principiante'> Principiante </option>";
                                echo "<option value='Intermedio'> Intermedio </option>";
                                echo "<option value='Avanzado'> Avanzado </option>";
                            }if($_SESSION['select_n'] == 'Principiante'){
                                echo "<option value=''>Todos Niveles </option>";  
                                echo "<option value='Principiante' selected> Principiante </option>";
                                echo "<option value='Intermedio'> Intermedio </option>";
                                echo "<option value='Avanzado'> Avanzado </option>";
                            }if($_SESSION['select_n'] == 'Intermedio'){  
                                echo "<option value=''>Todos Niveles </option>";  
                                echo "<option value='Principiante'> Principiante </option>";
                                echo "<option value='Intermedio' selected> Intermedio </option>";
                                echo "<option value='Avanzado'> Avanzado </option>";
                            }if($_SESSION['select_n'] == 'Avanzado'){ 
                                echo "<option value=''>Todos Niveles </option>";  
                                echo "<option value='Principiante'> Principiante </option>";
                                echo "<option value='Intermedio'> Intermedio </option>";
                                echo "<option value='Avanzado' selected> Avanzado </option>";
                            } 
                            echo '</select>';
                            echo '<select name="exercises" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona categoría" id="select_tip">';
                            echo "<option value='' >Todas Categorías </option>";
                            while ($row_tipo = mysqli_fetch_array($resC)) {
                                if($_SESSION['select_t'] == $row_tipo['tipo'] ){
                                    echo "<option value=" . $row_tipo['tipo'] . " selected>" . $row_tipo['tipo'] . " </option>";
                                }
                                else{
                                    echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                                }
                            }
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm  select_cabecera display-none" title="Selecciona cabecera" id="select_cab">';
                                echo "<option value=".$_SESSION['value_cab']."> ".$_SESSION['select_cab']." </option>";
                            echo '</select>';
                            if($_SESSION["showNumber"] != ''){
                        ?>
                            <p class="showNumberEntries display-none"><?php echo $_SESSION['showNumber'] ?></p>
                        <?php } else { ?>
                            <p class="showNumberEntries display-none">10</p>
                        <?php } 
                            $result = $ejer->getAllEjerciciosHabilitados($_SESSION['user']);
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
        <?php if (isset($_SESSION['msg_solucion_ok'])) {
                echo $_SESSION['msg_solucion_ok'];
                unset($_SESSION['msg_solucion_ok']);
        } ?>
        
    </div>
</div>
<?php include("footer.php"); ?>


