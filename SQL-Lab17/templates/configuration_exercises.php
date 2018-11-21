<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); 
$_SESSION['HOJA_EXE']= 1;
?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Ejercicios',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-12">
            <div class="text-right pl-5" >
                <a class="btn btn-primary pl-4 pr-4" id="new_exercice" href="#" ><?php echo trad('Crear Ejercicio',$lang) ?></a>
            </div>
        </div>
    </div>
    <div id="accordion ">
        <div class="card">  
            <div class="table-responsive no-buscar"> 
                
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:35%;"><?php echo trad('Descripción',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Profesor',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Nivel',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Tipo',$lang) ?></th>
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
                            
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_profe" title="Selecciona hoja" id="select_hoja">';
                            echo "<option name='' apellido1='' apellido2=''>Todos Profesores </option>";
                            while ($row_profe = mysqli_fetch_array($resP)) {
                                $apellidos = explode(" ",$row_profe['apellidos']);
                                echo "<option name=". $row_profe['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_profe['nombre'].' '. $row_profe['apellidos'] . " </option>";
                            }
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_nivel" title="Selecciona hoja" id="select_hoja">';
                            
                                echo "<option value=''>Todos Niveles </option>";
                                echo "<option value=facil> Facil </option>";
                                echo "<option value=medio> Medio </option>";
                                echo "<option value=dificil> Difícil </option>";
                                
                            echo '</select>';
                            echo '<select name="lista_hoja" class="custom-select form-control-sm mr-3 select_tipo" title="Selecciona hoja" id="select_hoja">';
                            echo "<option value=''>Todas Categorías </option>";
                            while ($row_tipo = mysqli_fetch_array($resC)) {
                                echo "<option value=" . $row_tipo['tipo'] . ">" . $row_tipo['tipo'] . " </option>";
                            }
                            echo '</select>';
                        $result = $ejer->getAllEjercicios();
                        while ($fila = mysqli_fetch_array($result)) {
                            $resul_sol = $sol->getCuantosEjerciciosByName($fila['id_ejercicio']);
                            $fila_sol = $resul_sol->fetch_array(MYSQLI_ASSOC);



                            $id = $fila['id_ejercicio'];
                            //$solucion = $sol->getAllEjerciciosByName($id);
                            //$fila_sol = mysqli_fetch_array($solucion);
                            if($fila['deshabilitar']==0){ ?>
                                <tr class="fondo_blanco" onclick="location='configuration_show_exercises.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">                                    
                                    <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>

                                    <?php echo '<td data-name="'. $fila['creador_ejercicio'] .'">' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?> 

                                    <?php //echo '<td>' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php if($_SESSION['user'] === $fila['creador_ejercicio']){ 
                                           if ($fila_sol["cantidad"] === "0"){?>
                                            
                                            <td style="text-align:right;">
                                                <a class="highlight_e" href="configuration_edit_exercises.php?exercise=<?php echo $fila['id_ejercicio']?>">
                                                    <i class="fas fa-edit mr-3" style="color:black; opacity:0.9;" title="<?php echo trad('Editar',$lang) ?>"></i>
                                                </a>
                                                <a method="post" class="highlight_b" href="../handler/validate_delete_exercise.php?eliminar=<?php echo $fila['id_ejercicio'] ?>">
                                                    <i class="fas fa-trash mr-3" style="color:black; opacity:0.9;" title="<?php echo trad('Eliminar',$lang) ?>"></i>
                                                </a>
                                            <?php } ?>
                                                <a class=" highlight_d" href="../handler/validate_deshabilitar.php?deshabilitar=<?php echo $fila['id_ejercicio'] ?>">
                                                    <i class="fas fa-unlock mr-3" style="color:black; opacity:0.9;" title="<?php echo trad('Deshabilitar',$lang) ?>"></i>
                                                </a>
                                                
                                            </td>
                                        <?php } else { ?>
                                        <td>
                                            <a class="mr-4" href="configuration_show_exercises.php?exercise=<?php echo $fila['id_ejercicio']?>"></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php
                            } else { ?>
                                <tr class="habilitar fondo_blanco" onclick="location='configuration_show_exercises.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">                                    
                                    <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                    <?php echo '<td title="'. $fila['creador_ejercicio'] .'">' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?> 
                                    <?php //echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                    <?php //echo '<td>' . $fila['nombre'].' '.$fila['apellidos'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php if($_SESSION['user']== $fila['creador_ejercicio']){ 
                                             if ($fila_sol["cantidad"] === "0"){?>
                                                <td style="text-align:right;">
                                                    <a class="highlight_e" href="configuration_edit_exercises.php?exercise=<?php echo $fila['id_ejercicio'] ?>">
                                                        <i class="fas fa-edit mr-3" title="<?php echo trad('Editar',$lang) ?>"></i>
                                                    </a>
                                                    <a method="post" class="highlight_b" href="../handler/validate_delete_exercise.php?eliminar=<?php echo $fila['id_ejercicio'] ?>">
                                                        <i class="fas fa-trash mr-3" title="<?php echo trad('Eliminar',$lang) ?>"></i>
                                                    </a>
                                            <?php } ?>
                                                    <a method="post" class="highlight_d" href="../handler/validate_habilitar.php?habilitar=<?php echo $fila['id_ejercicio'] ?>">
                                                        <i class="fas fa-lock mr-3" title="<?php echo trad('Habilitar',$lang) ?>"></i>
                                                    </a>
                                            </td>
                                    <?php } else { ?>
                                        <td>
                                            <a class="mr-4" href="configuration_show_exercises.php?exercise= <?php echo $fila['id_ejercicio'] ?>"></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php
                            }
                        } }?>

                    </tbody>
                </table>
                <?php
                // if(isset($_SESSION['msg_habilitar'])){
                //     echo $_SESSION['msg_habilitar'];
                //     unset($_SESSION['msg_habilitar']);
                // }
                if(isset($_SESSION['message_sheets'])){
                    echo $_SESSION['message_sheets'];
                    unset($_SESSION['message_sheets']);
                }
                if(isset($_SESSION['message_edit_sheets'])){
                    echo $_SESSION['message_edit_sheets'];
                    unset($_SESSION['message_edit_sheets']);
                }
                ?>
            </div>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
