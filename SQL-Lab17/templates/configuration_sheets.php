<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<?php unset($_SESSION['select_p']); unset($_SESSION['select_n']); unset($_SESSION['select_t'])?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Hoja de Ejercicios',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-12">
            <div class="text-right pl-5">
                <a class="btn btn-primary pl-5 pr-5" href="configuration_new_sheets.php" ><?php echo trad('Crear Hoja',$lang) ?></a>
            </div>
        </div>
    </div>
    <div id="accordion">
        <div class="card" >  
            <div class="table-responsive no-buscar">  
                <table id="employee_data" class="table table-striped-conf table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:30%"><?php echo trad('Nombre Hoja',$lang) ?></th>
                            <th style="width:20%"><?php echo trad('Nombre Profesor',$lang) ?></th>
                            <th style="width: 20%"><?php echo trad('N. Ejercicios',$lang) ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                        include_once '../inc/hoja_ejercicio.php';
                        include_once '../inc/esta_contenido.php';
                        $hojaejer = new HojaEjercicio();
                        $res = $hojaejer->getCreadorHojas();
                        $cont = 0;
                        if (isset($res)) {
                            echo '<select name="lista_hoja" class="custom-select form-control-sm select_profe" title="Selecciona hoja" id="select_hoja">';
                            echo "<option name='' apellido1='' apellido2=''>Todos Profesores </option>";
                            while ($row_hoja = mysqli_fetch_array($res)) {
                                $apellidos = explode(" ",$row_hoja['apellidos']);
                                echo "<option name=". $row_hoja['nombre']." apellido1=".$apellidos[0]." apellido2=".$apellidos[1].">" . $row_hoja['nombre'].' '. $row_hoja['apellidos']. " </option>";
                            }
                            echo '</select>';
                            $result = $hojaejer->getAllHojas();
                            while ($fila_hoja = mysqli_fetch_array($result)) {
                                ?>

                                <tr class="accordion-toggle" id="show-accordion" onclick="location='configuration_show_sheet.php?hoja=<?php echo $fila_hoja['id_hoja']; ?>'">
                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre_hoja'] . '</td>'; ?>

                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre'].' '.$fila_hoja['apellidos'] . '</td>'; ?>
                                    <?php
                                    $number = new EstaContenido();
                                    $id_hoja = $fila_hoja['id_hoja'];
                                    $row_number = $number->getNumberEjerciciosByHoja($id_hoja);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_number["COUNT(id_ejercicio)"] . '</td>';
                                    ?>
                                    <?php if($_SESSION['user'] == $fila_hoja['creador_hoja']){ ?>
                                    <?php echo '<td style="text-align:right;">'
                                            . ' <a class="highlight_e" href="configuration_edit_sheets.php?hoja=' . $fila_hoja['id_hoja'] . '"><i class="fas fa-edit mr-3" style="color:black; opacity:0.9;" title="Editar"></i></a>'
                                            . ' <a class="btn-sin-fondo highlight_b" href="../handler/validate_eliminar_hoja.php?eliminar_hoja=' . $fila_hoja['id_hoja'] . '"> <i class="fas fa-trash mr-3" style="color:black; opacity:0.9;" title="Eliminar"> </i></a> '                                  
                                            . '</td>'; 
                                    } else {?>
                                    <?php echo '<td>'
                                            . '<a class="" href="configuration_show_sheet.php?hoja=' . $fila_hoja['id_hoja'] . '"></a>'                                           
                                            . '</td>';
                                    }?>
                                </tr>
                                <?php $cont = $cont + 1;
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                    if(isset($_SESSION['message_sheets'])){
                        echo $_SESSION['message_sheets'];
                        unset($_SESSION['message_sheets']);
                    }
                    if(isset($_SESSION['msg_eleminar_hoja'])){
                        echo $_SESSION['msg_eleminar_hoja'];
                        unset($_SESSION['msg_eleminar_hoja']);
                    }
                    
                ?>
            </div>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
